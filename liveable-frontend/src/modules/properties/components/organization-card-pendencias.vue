<script setup lang="ts">
import CardImoveisPendencia from './Card-imoveis-pendencia.vue';


</script>

<template>
  <div class="alinhar-meio">
    <div class="container-organization">
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
    </div>
  </div>
</template>

<style scoped>
  .alinhar-meio {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .container-organization {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    width: 100%;
    justify-content: center;
  }

  @media (max-width: 768px) {
  .container-organization {
    grid-template-columns: 1fr;

    justify-items: center;
  }}
</style>
