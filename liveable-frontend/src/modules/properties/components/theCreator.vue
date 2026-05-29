<script setup lang="ts">
    import { PhCaretLeft, PhPencilSimpleLine, PhHouse, PhBuildingApartment, PhFarm, PhBed, PhBathtub, PhDresser, PhWifiHigh, PhMonitor, PhSidebar, PhCigarette, PhSnowflake, PhWashingMachine, PhHardDrive } from "@phosphor-icons/vue";
    import { ref } from "vue";
    import { exibir } from "../composables/useConfirmSolicitation";
    import { exibirConfirm } from "../composables/useConfirmSolicitation";
    import { getToken } from "../../../services/auth.js";
    /* Lógica pro input do tipo de propriedade agora */

    const tipoProp = ref<string | null>(null)

    function toggleTipo(tipo: string) {
        if (tipoProp.value === tipo) {
            tipo = 'Sair tudo!'
        }
        tipoProp.value = tipoProp.value === tipo ? null : tipo
    }

    // Definindo os valores

    const valor_diario = ref<number>();
    const valor_semanal = ref<number>();
    const valor_mensal = ref<number>();

    // Definindo o número dos detalhes
    const camas = ref<number>(1);
    const banheiros = ref<number>(1);
    const quartos = ref<number>(1);

    // Definindo se os checkbox estão ativos
    const wifi = ref<boolean>(false)
    const tv = ref<boolean>(false)
    const refrigerador = ref<boolean>(false)
    const fumaca = ref<boolean>(false)
    const ar = ref<boolean>(false)
    const maquina_lavar = ref<boolean>(false)
    const micro_ondas = ref<boolean>(false)
    const loading = ref<boolean>(false)
    const endereco = ref<string>("")
    const area_terreno = ref<string>("")
    const titulo = ref<string>("")
    const status = ref<string>('Disponível')
      function pegarImagem(event: Event) {
      const target = event.target as HTMLInputElement

      if (target.files && target.files.length > 0) {
        imagem.value = target.files[0]
      }
    }
    const imagem = ref<File | null>(null)

    // Fazendo o Fetch
    async function salvarImovel() {
  loading.value = true;

  try {
    const formData = new FormData();

    formData.append("type", tipoProp.value || "");
    formData.append("local", endereco.value);
    formData.append("area", area_terreno.value);
    formData.append("property_title", titulo.value);

    formData.append("pricePerDay", String(valor_diario.value || 0));
    formData.append("pricePerWeek", String(valor_semanal.value || 0));
    formData.append("pricePerMonth", String(valor_mensal.value || 0));

    formData.append("status", status.value);

    formData.append("beds_qtd", String(camas.value));
    formData.append("toilette", String(banheiros.value));
    // formData.append("quartos", String(quartos.value));

    formData.append("wifi", wifi.value ? "1" : "0");
    formData.append("tv", tv.value ? "1" : "0");
    formData.append("cooler", refrigerador.value ? "1" : "0");
    formData.append("air_conditioning", ar.value ? "1" : "0");
    formData.append("washer", maquina_lavar.value ? "1" : "0");
    formData.append("microwave", micro_ondas.value ? "1" : "0");

    // imagem
    if (imagem.value) {
      formData.append("images[]", imagem.value);
    }
    const token = getToken();
    const response = await fetch("http://127.0.0.1:8000/api/property/store", {
      method: "POST",
      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${token}`
      },
      body: formData
    });

    const data = await response.json();

    if (!response.ok) {
      console.log(data);
      alert("Erro ao salvar imóvel");
      return;
    }

    console.log(data);

    alert("Imóvel salvo com sucesso!");
  } catch (error) {
    console.error(error);
    alert("Erro no servidor");
  } finally {
    loading.value = false;
  }
}
</script>

<template>
    <div class="all">
        <div class="voltar" @click="exibirConfirm()">
            <PhCaretLeft :size="32" />
            <div class="circle-editor">
                <PhPencilSimpleLine class="editor-icon" />
            </div>
            <p>Criar Propriedade</p>
        </div>

        <div class="valores">
            <div class="valores-title">
                <p class="title-principal">Definição de valores</p>
                <p class="subtitulo">Preencha os valores de aluguel para exibi-los na simulação.</p>
            </div>

            <div class="valores-cards">
                <div class="valores-card valores-dia">
                    <div class="valores-card-cima">
                        <p>Valor diário</p>
                        <input type="checkbox">
                    </div>

                    <div class="valores-card-baixo">
                        <input type="number" v-model="valor_diario">
                    </div>
                </div>

                <div class="valores-card valores-semanal">
                    <div class="valores-card-cima">
                        <p>Valor Semanal</p>
                        <input type="checkbox">
                    </div>

                    <div class="divisoria"></div>

                    <div class="valores-card-baixo">
                        <input type="number" v-model="valor_semanal">
                    </div>
                </div>

                <div class="valores-card valores-mes">
                    <div class="valores-card-cima">
                        <p>Valor mensal</p>
                        <input type="checkbox">
                    </div>

                    <div class="divisoria"></div>

                    <div class="valores-card-baixo">
                        <input type="number" v-model="valor_mensal">
                    </div>
                </div>
            </div>
        </div>

        <div class="categoria">
            <div class="categoria-title">
                <p class="title-principal">Categoria do imóvel</p>
                <p class="subtitulo">Defina a categoria do imóvel que será exibida ao público.</p>
            </div>

            <div class="categoria-cards">
                <div class="categoria-card categoria-casa" @click="toggleTipo('casa')">
                    <div class="circle-categoria">
                        <PhHouse class="categoria-icon" />
                    </div>
                    <p>Casa</p>
                    <input type="radio" :checked="tipoProp === 'casa'">
                </div>

                <div class="categoria-card categoria-apartamento" @click="toggleTipo('apartamento')">
                    <div class="circle-categoria">
                        <PhBuildingApartment class="categoria-icon" />
                    </div>
                    <p>Apart.</p>
                    <input type="radio" :checked="tipoProp === 'apartamento'">
                </div>

                <div class="categoria-card categoria-chacara" @click="toggleTipo('chacara')">
                    <div class="circle-categoria">
                        <PhFarm class="categoria-icon" />
                    </div>
                    <p>Chácara</p>
                    <input type="radio" :checked="tipoProp === 'chacara'">
                </div>
            </div>
        </div>

        <div class="info-gerais">
            <div class="info-gerais-title">
                <p class="title-principal">Informações gerais</p>
            </div>

            <div class="info-gerais-inputs">

                <div class="info-gerais-input">
                    <div class="info-gerais-input">
                        <input type="text" v-model="endereco">
                        <div class="info-gerais-divisoria"></div>
                        <p>Endereço</p>
                    </div>
                </div>

                <div class="info-gerais-input">
                    <div class="info-gerais-input">
                        <input type="text" placeholder="Área do terreno" v-model="area_terreno">
                        <div class="info-gerais-divisoria"></div>
                        <p>m2</p>
                    </div>
                </div>

                <div class="info-gerais-input">
                    <div class="info-gerais-input">
                        <input type="text" v-model="titulo">
                        <div class="info-gerais-divisoria"></div>
                        <p>Título</p>
                    </div>
                </div>

                <div class="info-gerais-input">
                    <div class="info-gerais-input">
                        <input type="file" name="images" @change="pegarImagem">
                        <div class="info-gerais-divisoria"></div>
                        <p>Imagem</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detalhes">
            <div class="detalhes-title">
                <p class="title-principal">Detalhes</p>
                <p class="subtitulo">Mais informações que serão exibidas no post.</p>
            </div>

            <div class="detalhes-cards">
                <div class="detalhes-card">
                    <div class="detalhes-circle">
                        <PhBed :size="32" />
                    </div>
                    <button @click="camas--">-</button>
                    <p>{{ camas }}</p>
                    <button @click="camas++">+</button>
                </div>

                <div class="detalhes-card">
                    <div class="detalhes-circle">
                        <PhBathtub :size="32" />
                    </div>
                    <button @click="banheiros--">-</button>
                    <p>{{ banheiros }}</p>
                    <button @click="banheiros++">+</button>
                </div>

                <div class="detalhes-card">
                    <div class="detalhes-circle">
                        <PhDresser :size="32" />
                    </div>
                    <button @click="quartos--">-</button>
                    <p>{{ quartos }}</p>
                    <button @click="quartos++">+</button>
                </div>
            </div>
        </div>

        <div class="mais-detalhes">
            <div class="mais-detalhes-title">
                <p class="title-principal">Mais detalhes</p>
                <p class="subtitulo">Comodidades da acomodação.</p>
            </div>

            <div class="mais-detalhes-options">
                <div class="esquerda">
                     <label for=""><input type="checkbox" v-model="wifi"><PhWifiHigh class="mais-detalhes-icons"/> Wi-fi</label>
                     <label for=""><input type="checkbox" v-model="tv"><PhMonitor class="mais-detalhes-icons"/> TV</label>
                     <label for=""><input type="checkbox" v-model="refrigerador"><PhSidebar class="mais-detalhes-icons"/> Refrigerador</label>
                     <label for=""><input type="checkbox" v-model="fumaca"><PhCigarette class="mais-detalhes-icons"/> Detector de fumaça</label>
                </div>

                <div class="direita">
                     <label for=""><input type="checkbox" v-model="ar"><PhSnowflake class="mais-detalhes-icons"/> Ar condicionado</label>
                     <label for=""><input type="checkbox" v-model="maquina_lavar"><PhWashingMachine class="mais-detalhes-icons"/> Máquina de lavar</label>
                     <label for=""><input type="checkbox" v-model="micro_ondas"><PhHardDrive class="mais-detalhes-icons"/> Micro-ondas</label>
                </div>
            </div>
        </div>
        <button class="confirm-button" @click="salvarImovel()">Confirmar</button>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .all {
        position: fixed;
        z-index: 999;
        top: 0;
        right: 0;
        height: 100%;
        width: 100%;
        max-width: 600px;
        background-color: var(--color-bg-secondary);
        overflow-y: auto;
        box-sizing: border-box;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3rem;
        box-shadow: var(--shadow-md);
        color: var(--color-black-text);
    }

    .voltar {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
    }

    .circle-editor {
        aspect-ratio: 1/1;
        border: 1px solid var(--color-border-black);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .editor-icon {
        width: clamp(35px, 1.5vw, 40px);
    }

    /*Aqui começa a sessão de Valores*/

    .valores {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .valores-title {
        display: flex;
        flex-direction: column;
    }

    .valores-cards {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-around;
    }

    .valores-card {
        width: 30%;
        min-height: 150px;
        background-color: var(--color-bg);
        box-shadow: var(--shadow-sm);

        display: flex;
        flex-direction: column;
        border-radius: 12px;
        overflow: hidden;
        font-weight: 500;
    }

    .valores-card-cima {
        width: 100%;
        padding: 1rem;
        box-sizing: border-box;
        flex-shrink: 0;
        display: flex;
        justify-content: space-around;
        border-bottom: 1px solid var(--color-border);
        font-size: 0.9rem;
        align-items: center;
        cursor: pointer;
    }

    .valores-card-baixo {
        width: 100%;
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .valores-card-baixo input {
      height: 95%;
      width: 100%;
      border: 0;
    }


    /* Aqui começa a sessão de Categoria */

    .categoria {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .categoria-title {
        display: flex;
        flex-direction: column;
    }

    .categoria-cards {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-around;
    }

    .categoria-card {
        width: 30%;
        min-height: 60px;
        background-color: var(--color-bg);

        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-direction: row;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        cursor: pointer;
    }

    .circle-categoria {
        aspect-ratio: 1/1;
        border: 0.5px solid var(--color-border-black);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .categoria-icon {
        width: clamp(20px, 2.5rem, 40px);
    }


    /* Aqui começa a sessão de informações gerais */

    .info-gerais {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-gerais-title {
        display: flex;
        flex-direction: column;
    }

    .info-gerais-inputs {
        width: 100%;
        height: auto;
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 15px;
    }

    .info-gerais-input {
        width: 100%;
        height: auto;
        position: relative;
    }

    .info-gerais-input input {
        width: 100%;
        min-height: 52px;
        border-radius: 10px;
        border: 0;
        box-sizing: border-box;
        padding: 10px;
        box-shadow: var(--shadow-sm);
        background-color: var(--input-color);
    }

    .info-gerais-input p {
        position: absolute;
        right: 10px;
        top: 25%;
        border-left: 1px solid var(--color-perm-black-text);
        padding-left: 20px;
        font-weight: 500;
        color: var(--color-perm-black-text);
    }


    /* Aqui começa a sessão de detalhes */

    .detalhes {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .detalhes-title {
        display: flex;
        flex-direction: column;
    }

    .detalhes-cards {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-around;
    }

    .detalhes-card {
        width: 30%;
        min-height: 55px;
        border-radius: 13px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: var(--color-bg);
        box-shadow: var(--shadow-sm);
    }

    .detalhes-card button {
        background: 0;
        border: none;
        cursor: pointer;
    }

    /* Aqui começa a sessão de mais detalhes */

    .mais-detalhes {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .mais-detalhes-title {
        display: flex;
        flex-direction: column;
    }

    .mais-detalhes-options {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-around;
    }

    .esquerda {
        display: flex;
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .direita {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .esquerda, .direita label {
        display: flex;
        justify-content: center;
        font-size: 1.1rem;
    }

    .mais-detalhes-icons {
        width: clamp(35px, 1.5vw, 40px);
    }


    /* Configurações Universais */
    * {
        font-family: "Poppins", sans-serif;
    }

    p {
        margin: 0;
    }

    .title-principal {
        font-size: 1.2rem;
        font-weight: 650;
    }

    .subtitulo {
        opacity: 0.6;
        font-weight: 500;
    }

    button {
        color: var(--color-black-text);
    }

    .confirm-button {
      width: 100%;
      padding: 0.9rem 0;
      border: 0;
      background-color: var(--color-primary);
      color: var(--color-primary-text);
      border-radius: 15px;
      cursor: pointer;
      font-weight: 600;
    }
</style>
