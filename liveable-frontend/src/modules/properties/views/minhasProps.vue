<script setup lang="ts">
import CardCasa from '../components/CardCasa.vue';
import TheCreator from '../components/theCreator.vue';
import { exibir, exibirConfirm } from '@/modules/properties/composables/useConfirmSolicitation.ts'
</script>

<template>
  <div class="cima-title">
    <h2>Suas Propriedades</h2>
    <button @click="exibirConfirm()">+</button>
  </div>
    <div class="container-organization">
      <CardCasa />
    </div>
    <TheCreator v-if="exibir" />
</template>

<style scoped>
  .container-organization {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 350px));
    gap: 30px;
    width: 100%;
    justify-content: center;
  }

  .cima-title {
    display: flex;
    gap: 1rem;
    align-self: flex-start;
    align-items: center
  }

  .cima-title button {
    aspect-ratio: 1/1;
    border-radius: 50%;
    border: 0;
    font-size: 1.2rem;
    background-color: var(--color-primary);
    color: var(--color-primary-text);
    cursor: pointer;
  }

  h2 {
    align-self: flex-start;
    font-family: "Poppins", sans-serif;
    position: relative;
  }

  h2::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -3px;
    height: 3px;
    width: 75%;
    background-color: var(--color-primary);
    border-radius: 15px;
  }

  h2::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -3px;
    height: 3px;
    width: 20%;
    background-color: var(--color-primary);
    border-radius: 15px;
  }

  @media (max-width: 768px) {
  .container-organization {
    grid-template-columns: 1fr;

    justify-items: center;
  }}
</style>
