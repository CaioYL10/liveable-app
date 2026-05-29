<script setup lang="ts">
import { PhHeart} from "@phosphor-icons/vue";
import { useRouter } from 'vue-router';

// Receber dados

interface Property {
  id: number
  property_title: string
  pricePerDay: number
  avaliation: number
  images: {
    url: string
  }[]
}

defineProps<{
  casa: Property
}>()

const router = useRouter()

function goToDetails(id: number) {
  router.push(`/property-details/${id}`)
}
</script>

<template>
  <div class="card">
    <!-- Imagem -->
    <div class="cima" @click="goToDetails(casa.id)" :style="{ backgroundImage: `url(${casa?.images[0]?.url})` }">
      <div class="fav">
        <PhHeart weight="fill" class="icon-fav" :size="20" />
      </div>
    </div>

    <!-- Conteúdo inferior -->
    <div class="baixo">

      <!-- Título e preço -->
      <div class="textos">
        <p class="titulo">{{ casa?.property_title }}</p>
        <div class="subtexto">
          <p>R${{casa?.pricePerDay}} p/noite</p>
          <p>•</p>
          <p>★ {{ casa?.avaliation }}</p>
        </div>
      </div>

      <!-- Ações -->
      <div class="actions" @click="goToDetails(casa.id)">
        <button class="btn-confirm">Confirmar</button>
      </div>

    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

.card {
  width: 300px;
  background-color: var(--color-bg-secondary, #ffffff);
  border-radius: 24px;
  display: flex;
  flex-direction: column;
  font-family: "Poppins", sans-serif;
  box-shadow: var(--shadow-sm, 0 4px 16px rgba(0,0,0,0.10));
  color: var(--color-black-text, #1a1a1a);
  overflow: hidden;
}

/* ── Imagem ── */
.cima {
  width: 100%;
  height: 300px;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  border-radius: 20px;
  position: relative;
  cursor: pointer;
}

.fav {
  position: absolute;
  top: 12px;
  right: 12px;
  width: 36px;
  height: 36px;
  background-color: #fff;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  transition: box-shadow 0.3s;
  cursor: pointer;
}

.fav:hover {
  box-shadow: var(--shadow-hover-blue, 0 4px 12px rgba(59,130,246,0.4));
}

.icon-fav {
  color: var(--color-primary, #3b82f6);
}

/* ── Conteúdo ── */
.baixo {
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding: 15px;
}

/* Título */
.textos {
  display: flex;
  flex-direction: column;
}

.titulo {
  margin: 0;
  font-size: 15px;
  font-weight: 600;
}

.subtexto {
  font-size: 13px;
  opacity: 0.6;
  display: flex;
  gap: 10px;
  font-size: clamp(0.7rem, 0.81vw, 0.85rem);
}

/* Quem solicitou */
.label-solicitou {
  margin: 0 0 8px 0;
  font-size: 14px;
  font-weight: 600;
}

.card-contato {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-radius: 14px;
  box-shadow: var(--shadow-sm, 0 2px 8px rgba(0,0,0,0.08));
  background-color: var(--color-bg-secondary, #fff);
}

.card-contato .img {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background-position: center;
  background-size: cover;
  flex-shrink: 0;
}

.owner-name {
  margin: 0;
  flex: 1;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

.icon-phone {
  color: var(--color-black-text, #1a1a1a);
  cursor: pointer;
  flex-shrink: 0;
}

/* Botões */
.actions {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 4px;
}

.btn-details {
  background: none;
  border: none;
  font-family: "Poppins", sans-serif;
  font-size: 13px;
  font-weight: 500;
  color: var(--color-black-text, #1a1a1a);
  cursor: pointer;
  padding: 4px 0;
  text-align: center;
  opacity: 0.75;
  transition: opacity 0.2s;
}

.btn-details:hover {
  opacity: 1;
}

.btn-confirm {
  width: 100%;
  height: 42px;
  border-radius: 14px;
  cursor: pointer;
  border: none;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 14px;
  background-color: var(--color-primary, #3b82f6);
  color: var(--color-primary-text, #ffffff);
  transition: background-color 0.3s;
}

.btn-confirm:hover {
  background-color: var(--color-primary-hover, #2563eb);
}
</style>
