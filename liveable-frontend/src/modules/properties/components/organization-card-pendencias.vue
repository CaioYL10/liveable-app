<script setup lang="ts">
import CardImoveisPendencia from './Card-imoveis-pendencia.vue';


</script>

<template>
    <div class="container-organization">
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
      <CardImoveisPendencia />
    </div>
</template>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  .container-organization {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 350px));
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
