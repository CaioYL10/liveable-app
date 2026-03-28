<script setup lang="ts">
  import { onMounted } from 'vue'

  // isso vai sair quando o router for arrumado, está forma de import esta aqui só para testes
  import baseLayout from '@/shared/layouts/baseLayout.vue';

  onMounted(() => {
    document.documentElement.setAttribute('data-theme', 'light')
  })
</script>

<template>
  <baseLayout />
</template>