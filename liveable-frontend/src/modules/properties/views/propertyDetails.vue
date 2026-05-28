<script setup lang="ts">
  import TheExib from '@/modules/properties/components/TheExib.vue';
  import TheEditor from '../components/TheEditor.vue';
  import { exibir } from '@/modules/properties/composables/useEditor.ts'
</script>

<template>
    <TheExib />
    <TheEditor v-if="exibir" />
</template>
