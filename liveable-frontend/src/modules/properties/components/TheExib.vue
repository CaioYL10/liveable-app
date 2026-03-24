<script setup lang="ts">
    import { PhHeart, PhPhone } from "@phosphor-icons/vue";
    import { ref } from "vue";
    import VueSlider from "vue-slider-component"
    import "vue-slider-component/theme/default.css"

    const valor = ref<number>(3);
    const valordiaCasa = ref<number>(130.00);
</script>

<template>
    <div class="all">
        <div class="home-title">
            <p>Casa de Férias em Ubatuba</p>
        </div>
        <div class="home-details">
            <div class="home-photo"></div>
            <div class="home-informations">
                <div class="ende">
                    <div class="casa-endereco">
                        <p>201 Prade Dr, San Jose, CA 95119</p>
                    </div>
                    <div class="fav"><PhHeart weight="fill" class="icon-fav"/></div>
                </div>
                <div class="info">
                    <p>4 Camas</p>
                    <div class="divisoria"></div>
                    <p>3 Banheiros</p>
                    <div class="divisoria"></div>
                    <p>50m²</p>
                </div>
                <div class="simulation">
                    <p>Simulação de preço: R${{ valor * valordiaCasa }},00</p>
                    <div class="juntar">
                        <VueSlider class="slider" :min="0" :max="10" v-model="valor" :tooltip="'always'" tooltip-placement="bottom" />
                        <p class="n-baixo">N. de dias</p>
                    </div>
                </div>
                <div class="contact">
                    <div class="contato-escrita">Contato:</div>
                    <div class="card-contato">
                        <div class="img"></div>
                        <p>Wanderley Avanze</p>
                        <PhPhone class="icon-phone"/>
                    </div>
                </div>
                <button>Solicitar</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .all {
        width: 95%;
        display: flex;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        gap: 20px;
    }

    .home-title {
        width: 100%;
        height: 12%;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        font-size: clamp(1.6rem, 3vw, 2.8rem);
    }

    .home-title p {
        margin: 0;
    }

    .home-details {
        width: 100%;
        height: auto;
        display: flex;
        align-items: stretch;
        justify-content: space-between;
    }

    .home-photo {
        width: 67%;
        aspect-ratio: 16 / 9;
        height: auto;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
        background-image: url(https://projetaronline.com/wp-content/uploads/2025/04/P451-FOTOS_16-Foto.jpg);
        background-size: cover;
        background-position: center;
    }

    .home-informations {
        width: 30%;
        height: auto;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
        box-sizing: border-box;
        padding: 40px;
        gap: 30px;
    }

    .home-informations .ende {
        width: 100%;
        min-height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ende p {
        margin: 0;
    }

    .fav {
        width: 3rem;
        height: 3rem;
        aspect-ratio: 1 / 1;
        background-color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
        transition: box-shadow 0.3s;
        cursor: pointer;
    }

    .fav:hover {
        box-shadow: 0 4px 10px rgba(16, 37, 226, 0.486);
    }

    .icon-fav {
        color: #D9D9D9;
        width: clamp(35px, 2.5vw, 40px);
        height: clamp(35px, 2.5vw, 40px);
    }

    .casa-endereco {
        width: 80%;
        height: 100%;
        display: flex;
        align-items: center;
        font-size: clamp(1.6rem, 1.5vw, 2.2rem);
        font-weight: 600;
    }

    .home-informations .info {
        width: 100%;
        min-height: 55px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        border-radius: 20px;
        padding: 10px;
        box-sizing: border-box;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
        font-size: clamp(0.9rem, 0.8vw, 1.6rem);
    }

    .info .divisoria {
        height: 3rem;
        flex-shrink: 0;
        border-radius: 20px;
        width: 1px;
        background-color: black;
    }

    .home-informations .simulation {
        width: 100%;
        min-height: 70px;
        font-size: clamp(1.1rem, 1.1vw, 1.8rem);
        text-wrap: nowrap;
    }

    .slider {
        width: 100%;
    }

    :deep(.vue-slider-dot-tooltip-text){
        font-size: clamp(1.1rem, 1vw, 30px);
    }

    :deep(.vue-slider-process){
        background: #2563eb;
    }

    :deep(.vue-slider-rail){
        background: #D9D9D9;
    }

    :deep(.vue-slider-dot-tooltip-inner){
        background-color: transparent;
        color: black;
    }

    :deep(.vue-slider-dot-tooltip-inner-bottom::after){
        border-bottom-color: #2563eb;
    }

    .juntar {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .n-baixo {
        margin: 0;
        position: absolute;
        right: 0;
        top: 70%;
        font-size: clamp(1rem, 1vw, 1.5rem);
        opacity: 0.6;
    }

    .home-informations .contact {
        width: 100%;
        height: auto;
        gap: 10px;

        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .contato-escrita {
        width: 100%;
        min-height: 30px;
        display: flex;
        align-items: center;
        font-size: clamp(1rem, 1vw, 1.6rem);
    }

    .card-contato {
        width: 100%;
        min-height: 60px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        font-size: clamp(1.1rem, 1.05vw, 1.6rem);
        font-weight: 500;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
    }

    .card-contato .img {
        height: 3rem;
        aspect-ratio: 1 / 1;
        border-radius: 50%;
        background-image: url(https://static.vecteezy.com/ti/fotos-gratis/t2/23308898-ai-generativo-uma-homem-em-solido-cor-fundo-com-uma-sorrir-facial-expressao-foto.jpg);
        background-position: center;
        background-size: 150% 100%;
        cursor: pointer;
    }

    .card-contato p {
        cursor: pointer;
    }

    .icon-phone {
        cursor: pointer;
        width: clamp(1.8rem, 1vw, 2.2rem);
        height: clamp(1.8rem, 1vw, 2.2rem);
    }

    .home-informations button {
        width: 100%;
        min-height: 65px;
        background-color: blue;
        border-radius: 20px;
        border: none;
        color: white;
        font-family: "Poppins", sans-serif;
        font-size: clamp(1.1rem, 1.15vw, 30px);
        font-weight: 600;
        cursor: pointer;
        transition: background-color 1s;
    }

    .home-informations button:hover {
        background-color: rgb(0, 132, 255);
    }

    @media (max-width: 768px) {
    .all {
        aspect-ratio: auto;
        min-height: auto;
        width: 95%;
        margin: 0 auto;
    }

    .home-details {
        flex-direction: column;
        gap: 15px;
    }

    .home-photo {
        width: 100%;
        aspect-ratio: 16 / 9;
        height: auto;
    }

    .home-informations {
        width: 100%;
        gap: 40px;
        box-sizing: border-box;
        padding-bottom: 40px;
        padding-top: 40px;
    }
}
</style>