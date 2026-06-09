<script setup lang="ts">
import { PhHeart, PhPhone, PhCheck } from "@phosphor-icons/vue";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

import VueSlider from "vue-slider-component"
import "vue-slider-component/theme/default.css"

import InfosProperties from "./InfosProperties.vue";
import { exibirConfirm } from '@/modules/properties/composables/useConfirmSolicitation.ts'
import AvaliationSession from "./avaliation-session.vue";

interface Property {
id: number
property_title: string
local: string
beds_qtd: number
toilette: number
area: number
pricePerDay: number
owner_contact: string | null
images: { url: string }[]
user: {
  id: number
  name: string
  last_name: string
  profile_picture: string | null
  phone: string | null
} | null
}

const route = useRoute()
const propertyId = route.params.id
const property = ref<Property | null>(null)
const valor = ref<number>(3)
const copiado = ref(false)

onMounted(async () => {
try {
  const res = await fetch(`http://127.0.0.1:8000/api/property/${propertyId}`, {
    headers: {
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
      'Accept': 'application/json',
    }
  })
  const data = await res.json()
  property.value = data.Propriedade
} catch (error) {
  console.error(error)
}
})

async function copiarContato() {
const contato = property.value?.user?.phone
if (!contato) return
try {
  await navigator.clipboard.writeText(contato)
  copiado.value = true
  setTimeout(() => (copiado.value = false), 2000)
} catch {
  console.error('Erro ao copiar')
}
}

const router = useRouter()

function verPerfil() {
if (property.value?.user) {
  router.push(`/perfil/${property.value.user.id}`)
}
}
</script>

<template>
<div class="all">
  <div class="home-title">
    <p>{{ property?.property_title }}</p>
  </div>
  <div class="home-details">
    <div class="home-photo" :style="property?.images?.[0]?.url ? { backgroundImage: `url('${encodeURI(property.images[0].url)}')` } : {}"></div>
    <div class="home-informations">
      <div class="ende">
        <div class="casa-endereco">
          <p>{{ property?.local }}</p>
        </div>
        <div class="fav"><PhHeart weight="fill" class="icon-fav"/></div>
      </div>
      <div class="info">
        <p>{{ property?.beds_qtd }} Camas</p>
        <div class="divisoria"></div>
        <p>{{ property?.toilette }} Banheiros</p>
        <div class="divisoria"></div>
        <p>{{ property?.area }} m²</p>
      </div>
      <div class="simulation">
        <p>Simulação de preço: R$ {{ valor * (property?.pricePerDay || 0) }}</p>
        <div class="juntar">
          <VueSlider class="slider" :min="0" :max="10" v-model="valor" :tooltip="'always'" tooltip-placement="bottom" />
          <p class="n-baixo">N. de dias</p>
        </div>
      </div>
      <div class="contact">
        <div class="contato-escrita">Contato:</div>
        <div class="card-contato" @click="copiarContato" :class="{ copiado }">
          <div
            class="img"
            :class="{ semFoto: !property?.user?.profile_picture }"
            @click="verPerfil"
            :style="property?.user?.profile_picture
              ? { backgroundImage: `url('http://127.0.0.1:8000/storage/${property.user.profile_picture}')` }
              : {}"
          >
            <span v-if="!property?.user?.profile_picture">
              {{ property?.user?.name?.charAt(0) }}
            </span>
          </div>
          <p @click="verPerfil">{{ property?.user?.name }} {{ property?.user?.last_name }}</p>
          <div class="phone-icon-wrap" :class="{ copiado }">
            <PhCheck v-if="copiado" class="icon-phone" weight="bold" />
            <PhPhone v-else class="icon-phone" />
          </div>
        </div>
        <Transition name="toast">
          <div v-if="copiado" class="toast">
            📋 Número copiado para a área de transferência!
          </div>
        </Transition>
      </div>
      <button @click="exibirConfirm()">Solicitar</button>
    </div>
  </div>

  <InfosProperties />
  <AvaliationSession :property-id="Number(propertyId)" :price-per-night="property?.pricePerDay ?? 0" />
</div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.all {
width: 95%;
display: flex;
flex-direction: column;
font-family: "Poppins", sans-serif;
gap: 20px;
margin-top: 1vw;
margin-bottom: 1vw;
}

.home-title {
width: 100%;
height: 12%;
font-weight: 600;
display: flex;
align-items: center;
justify-content: flex-start;
font-size: clamp(1.6rem, 3vw, 2.8rem);
color: var(--color-black-text);
}

.home-title p { margin: 0; }

.home-details {
width: 100%;
height: auto;
display: flex;
align-items: flex-start;
justify-content: space-between;
}

.home-photo {
width: 64%;
aspect-ratio: 16 / 9;
height: auto;
border-radius: 30px;
box-shadow: var(--shadow-sm);
background-size: cover;
background-position: center;
}

.home-informations {
width: 35%;
height: auto;
border-radius: 30px;
display: flex;
flex-direction: column;
justify-content: space-around;
box-shadow: var(--shadow-sm);
box-sizing: border-box;
padding: 40px;
gap: 30px;
background-color: var(--color-bg-secondary);
color: var(--color-black-text);
}

.home-informations .ende {
width: 100%;
min-height: 60px;
display: flex;
justify-content: space-between;
align-items: center;
}

.ende p { margin: 0; }

.fav {
width: 3rem;
height: 3rem;
aspect-ratio: 1 / 1;
background-color: var(--color-bg);
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
box-shadow: var(--shadow-sm);
transition: box-shadow 0.3s;
cursor: pointer;
}

.fav:hover { box-shadow: var(--shadow-hover-blue); }

.icon-fav {
color: var(--color-icon-inactive);
width: clamp(35px, 2.5vw, 40px);
height: clamp(35px, 2.5vw, 40px);
}

.casa-endereco {
width: 80%;
height: 100%;
display: flex;
align-items: center;
font-size: clamp(1.6rem, 1.5vw, 2.2rem);
font-weight: 600;
}

.home-informations .info {
width: 100%;
min-height: 55px;
display: flex;
align-items: center;
justify-content: space-around;
border-radius: 20px;
padding: 10px;
box-sizing: border-box;
font-weight: 600;
box-shadow: var(--shadow-sm);
font-size: clamp(0.9rem, 0.8vw, 1.6rem);
}

.info .divisoria {
height: 3rem;
flex-shrink: 0;
border-radius: 20px;
width: 1px;
background-color: var(--color-border-black);
}

.home-informations .simulation {
width: 100%;
min-height: 70px;
font-size: clamp(1.1rem, 1.1vw, 1.8rem);
text-wrap: nowrap;
}

.slider { width: 100%; }

:deep(.vue-slider-dot-tooltip-text) { font-size: clamp(1.1rem, 1vw, 30px); }
:deep(.vue-slider-process) { background: var(--color-primary); }
:deep(.vue-slider-rail) { background: var(--vue-slider-trilha-color); }
:deep(.vue-slider-dot-tooltip-inner) { background-color: transparent; color: var(--color-black-text); }
:deep(.vue-slider-dot-tooltip-inner-bottom::after) { border-bottom-color: var(--color-primary); }

.juntar {
display: flex;
flex-direction: column;
position: relative;
}

.n-baixo {
margin: 0;
position: absolute;
right: 0;
top: 70%;
font-size: clamp(1rem, 1vw, 1.5rem);
opacity: 0.6;
}

.home-informations .contact {
width: 100%;
height: auto;
gap: 10px;
display: flex;
flex-direction: column;
justify-content: space-between;
position: relative;
}

.contato-escrita {
width: 100%;
min-height: 30px;
display: flex;
align-items: center;
font-size: clamp(1rem, 1vw, 1.6rem);
}

.card-contato {
width: 100%;
min-height: 60px;
display: flex;
justify-content: space-around;
align-items: center;
font-size: clamp(1.1rem, 1.05vw, 1.6rem);
font-weight: 500;
border-radius: 15px;
box-shadow: var(--shadow-sm);
cursor: pointer;
transition: box-shadow 0.3s, background-color 0.3s;
}

.card-contato:hover {
box-shadow: var(--shadow-hover-blue);
}

.card-contato.copiado {
background-color: #e8f5e9;
}

.card-contato .img {
height: 3rem;
aspect-ratio: 1 / 1;
border-radius: 50%;
background-position: center;
background-size: cover;
cursor: pointer;
}

.card-contato .img.semFoto {
  background-color: #cfcfcf;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #666;
  font-weight: 600;
}

.card-contato p { cursor: pointer; margin: 0; }

.phone-icon-wrap {
width: clamp(1.8rem, 1vw, 2.2rem);
height: clamp(1.8rem, 1vw, 2.2rem);
display: flex;
align-items: center;
justify-content: center;
transition: color 0.3s;
}

.phone-icon-wrap.copiado { color: #2e7d32; }

.icon-phone {
width: 100%;
height: 100%;
}

.toast {
position: absolute;
bottom: -2.8rem;
left: 50%;
transform: translateX(-50%);
background: #1a2fa8;
color: white;
padding: 8px 18px;
border-radius: 20px;
font-size: 0.78rem;
font-weight: 600;
white-space: nowrap;
box-shadow: 0 4px 15px rgba(26, 47, 168, 0.35);
}

.toast-enter-active, .toast-leave-active { transition: opacity 0.3s, transform 0.3s; }
.toast-enter-from { opacity: 0; transform: translateX(-50%) translateY(6px); }
.toast-leave-to { opacity: 0; transform: translateX(-50%) translateY(6px); }

.home-informations button {
width: 100%;
min-height: 65px;
background-color: var(--color-primary);
border-radius: 20px;
border: none;
color: white;
font-family: "Poppins", sans-serif;
font-size: clamp(1.1rem, 1.15vw, 30px);
font-weight: 600;
cursor: pointer;
transition: background-color 1s;
}

.home-informations button:hover { background-color: var(--color-primary-hover); }

@media (max-width: 768px) {
.all {
  aspect-ratio: auto;
  min-height: auto;
  width: 95%;
  margin-top: 7vw;
  margin-bottom: 7vw;
}

.home-details {
  flex-direction: column;
  gap: 15px;
}

.home-photo {
  width: 100%;
  aspect-ratio: 16 / 9;
  height: auto;
}

.home-informations {
  width: 100%;
  gap: 40px;
  box-sizing: border-box;
  padding-bottom: 40px;
  padding-top: 40px;
}
}
</style>
