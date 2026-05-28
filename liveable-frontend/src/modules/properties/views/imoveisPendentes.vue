<script setup lang="ts">
import OrganizationCardPendencias from '../components/organization-card-pendencias.vue';


</script>

<template>
  <div class="container-all-organization">
    <div class="title">
      <h1>Seus imóveis em <span>Pendência</span></h1>
      <i class="fa-solid fa-stopwatch"></i>
    </div>
    <OrganizationCardPendencias />
  </div>
</template>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  .container-all-organization {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    gap: 1.5rem;
    font-family: "Poppins", sans-serif;
  }

  h1 {
    font-size: 1.3rem;
    font-weight: 600;
    position: relative;
    color: var(--color-black-text);
  }

  .title {
    align-self: flex-start;
    display: flex;
    gap: 10px;
    align-items: center;
    font-size: 1.3rem;
    color: var(--color-primary);
  }

  h1 span {
    color: var(--color-primary);
  }

  h1::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: -3px;
  height: 3px;
  width: 75%;
  background-color: var(--color-primary);
  border-radius: 15px;
  }

  h1::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -3px;
    height: 3px;
    width: 20%;
    background-color: var(--color-primary);
    border-radius: 15px;
  }
</style>
