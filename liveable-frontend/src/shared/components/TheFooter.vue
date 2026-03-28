<script setup lang="ts">
    import { PhGlobe, PhInstagramLogo, PhFacebookLogo, PhXLogo } from "@phosphor-icons/vue";
</script>

<template>
    <div class="container">
        <div class="cima">
            <div>
                <h3>Inspiração para viagens futuras</h3>
            </div>

            <div class="destinations">
                <div class="destination-group">
                    <a href="">Ilhabela, SP</a>
                    <a href="">Trancoso, BA</a>
                    <a href="">Búzios, RJ</a>
                </div>
                
                <div class="destination-group">
                    <a href="">Ibiza, Espanha</a>
                    <a href="">Positano, Itália</a>
                    <a href="">Santorini, Grécia</a>
                </div>

                <div class="destination-group">
                    <a href="">Tóquio, Japão</a>
                    <a href="">Lisboa, Portugal</a>
                    <a href="">Nova York, EUA</a>
                </div>
            </div>
        </div>

        <div class="baixo">
            <div class="baixo-group-1">
                <p>&copy; 2026 Liveable, inc</p>
                <a href="">Privacidade</a>
                <a href="">Termos</a>
                <a href="">Informações</a>
            </div>

            <div class="baixo-group-2">
                <!-- Precisei criar esta classe para alinhar a escrita com o icone -->
                <div class="baixo-group-icon-text">
                    <PhGlobe :size="20" />
                    <p>Português (BR)</p>
                </div>

                <p>R$ BLR</p>

                <div>
                    <PhInstagramLogo :size="20" />
                    <PhFacebookLogo :size="20" />
                    <PhXLogo :size="20" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .container {
        background-color: var(--footer-color);
        width: 100%;
        height: auto;
        color: black;
        font-family: "Poppins", sans-serif;
        box-sizing: border-box;
        padding: 1rem 3rem;
        color: var(--color-black-text);
    }

    .cima {
        display: flex;
        flex-direction: column;
    }

    .destinations {
        display: flex;
        flex-direction: row;
        gap: clamp(2rem, 4rem, 8rem);
    }

    .destinations .destination-group {
        display: flex;
        flex-direction: column;
    }

    .baixo {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .baixo .baixo-group-1, .baixo-group-2 {
        display: flex;
        align-items: center;
    }

    .baixo-group-1 {
        gap: 1rem;
    }

    .baixo-group-2 {
        gap: 2rem;
    }

    .baixo-group-icon-text {
        display: flex;
        align-items: center;
    }


    /* Configurações Globais */

    a {
        color: currentColor;
    }
</style>