<script setup lang="ts">
    // isso vai sair quando o router for arrumado, está forma de import esta aqui só para testes
    import propertyDetails from '@/modules/properties/views/propertyDetails.vue';

    import TheNav from '../components/TheNav.vue';
import TheFooter from '../components/TheFooter.vue';
</script>

<template>
    <header>
        <nav><TheNav /></nav>
    </header>

    <main>
        <propertyDetails />
    </main>

    <footer>
        <TheFooter />
    </footer>
</template>