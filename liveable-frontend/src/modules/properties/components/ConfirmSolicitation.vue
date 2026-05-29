<script setup lang="ts">
    import { PhCaretLeft, PhPencilSimpleLine, PhHouse, PhBuildingApartment, PhFarm, PhBed, PhBathtub, PhDresser, PhWifiHigh, PhMonitor, PhSidebar, PhCigarette, PhSnowflake, PhWashingMachine, PhHardDrive } from "@phosphor-icons/vue";
    import { ref } from "vue";
    import { exibirConfirm } from '@/modules/properties/composables/useConfirmSolicitation'
import TheCalendary from "@/shared/components/TheCalendary.vue";

    /* Lógica para o input radio desativar se clicar dnv */

    const tipoInput = ref<string[]>([]);

    function toggle(tipo: string) {
        if (tipoInput.value.includes(tipo)) {
            tipoInput.value = tipoInput.value.filter(t => t !== tipo)
        } else {
            tipoInput.value.push(tipo)
        }
    }

    /* Lógica pro input do tipo de propriedade agora */

    const tipoProp = ref<string | null>(null)

    function toggleTipo(tipo: string) {
        if (tipoProp.value === tipo) {
            tipo = 'Sair tudo!'
        }
        tipoProp.value = tipoProp.value === tipo ? null : tipo
    }
</script>

<template>
    <div class="all">
        <div class="voltar" @click="exibirConfirm()">
            <PhCaretLeft :size="32" />
            <div class="circle-editor">
                <i class="fa-regular fa-newspaper editor-icon"></i>
            </div>
            <p>Confirmar Solicitação</p>
        </div>

        <TheCalendary />

        <div class="mais-detalhes">
            <div class="mais-detalhes-title">
                <p class="title-principal">Mais detalhes</p>
                <p class="subtitulo">Comodidades da acomodação.</p>
            </div>

            <div class="mais-detalhes-options">
                <div class="esquerda">
                     <label for=""><PhWifiHigh class="mais-detalhes-icons"/> Wi-fi</label>
                     <label for=""><PhMonitor class="mais-detalhes-icons"/> TV</label>
                     <label for=""><PhSidebar class="mais-detalhes-icons"/> Refrigerador</label>
                     <label for=""><PhCigarette class="mais-detalhes-icons"/> Detector de fumaça</label>
                </div>

                <div class="direita">
                     <label for=""><PhSnowflake class="mais-detalhes-icons"/> Ar condicionado</label>
                     <label for=""><PhWashingMachine class="mais-detalhes-icons"/> Máquina de lavar</label>
                     <label for=""><PhHardDrive class="mais-detalhes-icons"/> Micro-ondas</label>
                </div>
            </div>
        </div>

        <div class="infos-prop">
          <p>Informações ao proprietário</p>
          <div class="inputs-prop">
            <div class="esquerda-infos">
              <input class="num-persons" type="number" placeholder="N de pessoas">
              <div class="pet-input">
                <div class="pet-title">
                  <i class="fa-solid fa-paw"></i>
                  <p>Pet</p>
                </div>
                <div class="inputs-radio">
                  <label for="">Sim</label>
                  <input type="checkbox">
                </div>

                <div class="inputs-radio">
                  <label for="">Não</label>
                  <input type="checkbox">
                </div>

              </div>
            </div>

            <textarea placeholder="Mais detalhes..."></textarea>
          </div>
        </div>

        <button class="confirm-button">Confirmar</button>
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
        font-family: "Poppins", sans-serif;
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
        gap: 1rem;
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

    /* Aqui começa os inputs de informações ao proprietário */
    .infos-prop {
      width: 100%;
      height: auto;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      justify-content: space-around;
    }

    .inputs-prop {
      display: flex;
      justify-content: space-between;
    }

    .esquerda-infos {
      width: 48%;
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
    }

    .esquerda-infos .num-persons {
      padding: 0.7rem 0;
      padding-left: 1rem;
      width: 100%;
      border-radius: 7px;
      border: 0;
      box-shadow: var(--shadow-sm);
      box-sizing: border-box;

    }

    .inputs-prop textarea {
      width: 48%;
      resize: none;
      border-radius: 10px;
      box-shadow: var(--shadow-sm);
      border: 0;
      box-sizing: border-box;
      padding-left: 0.7rem;
      padding-top: 0.7rem;
    }

    .pet-input {
      display: flex;
      justify-content: space-around;
      box-shadow: var(--shadow-sm);
      background-color: var(--color-bg);
      border-radius: 7px;
      align-items: center;
      padding: 0.7rem;
    }

    .pet-title {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .inputs-radio {
      display: flex;
      gap: 5px;
    }



    /* Configurações Universais */
    button, input, textarea {
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
