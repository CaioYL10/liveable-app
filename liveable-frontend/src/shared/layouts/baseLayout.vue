<script setup lang="ts">
    // isso vai sair quando o router for arrumado, está forma de import esta aqui só para testes
    import propertyDetails from '@/modules/properties/views/propertyDetails.vue';

    import TheNav from '../components/TheNav.vue';
    import TheFooter from '../components/TheFooter.vue';
import ViewProfile from '@/modules/profile/views/viewProfile.vue';
import LoginView from '@/modules/login/views/loginView.vue';
</script>

<template>
    <header>
        <nav></nav>
    </header>

    <main>
        <LoginView />
    </main>

    <footer>
        
    </footer>
</template>