<script setup lang="ts">
    import { PhGlobe, PhInstagramLogo, PhFacebookLogo, PhXLogo } from "@phosphor-icons/vue";
</script>

<template>
    <div class="cima">
        <div>
            <h3>Inspiração para viagens futuras</h3>
        </div>

        <div class="destinations">
            <div>
                <a href="">Ilhabela, SP</a>
                <a href="">Trancoso, BA</a>
                <a href="">Búzios, RJ</a>
            </div>
            
            <div>
                <a href="">Ibiza, Espanha</a>
                <a href="">Positano, Itália</a>
                <a href="">Santorini, Grécia</a>
            </div>

            <div>
                <a href="">Tóquio, Japão</a>
                <a href="">Lisboa, Portugal</a>
                <a href="">Nova York, EUA</a>
            </div>
        </div>
    </div>

    <div class="baixo">
        <div>
            <p>&copy; 2026 Liveable, inc</p>
            <a href="">Privacidade</a>
            <a href="">Termos</a>
            <a href="">Informações</a>
        </div>

        <div>
            <p>
                <PhGlobe :size="32" />
                Português (BR)
            </p>

            <p>R$ BLR</p>

            <div>
                <PhInstagramLogo :size="32" />
                <PhFacebookLogo :size="32" />
                <PhXLogo :size="32" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>