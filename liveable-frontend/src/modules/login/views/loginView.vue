<script setup lang="ts">
import LoginBanner from '../components/loginBanner.vue';
import LoginInputs from '../components/loginInputs.vue';


</script>

<template>
  <div class="container-large">
    <LoginBanner />
    <LoginInputs />
  </div>
</template>

<style scoped>
  .container-large {
    display: flex;
    justify-content: space-around;

    width: 95%;
    min-height: 90vh;
  }
</style>
