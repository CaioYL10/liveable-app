<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue'

import { onMounted, ref } from "vue";

import 'swiper/css'
import 'swiper/css/navigation'

import { Navigation } from 'swiper/modules'

import CardEmAlta from './Card-em-alta.vue'

const prevButton = ref(null)
const nextButton = ref(null)

const onSwiper = (swiper: any) => {
  setTimeout(() => {
    if (
      swiper.params.navigation &&
      typeof swiper.params.navigation !== 'boolean'
    ) {
      swiper.params.navigation.prevEl = prevButton.value
      swiper.params.navigation.nextEl = nextButton.value
    }

    swiper.navigation.destroy()
    swiper.navigation.init()
    swiper.navigation.update()
  })
}

// Logica de receber dados

interface Property {
  id: number
  title: string
  pricePerDay: number
  avaliation: number
  image: string
  clicks: number
}

const properties = ref<Property[]>([])

onMounted(async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/properties')
    const data = await response.json()
    properties.value = data
  } catch (error) {
    console.error(error)
  }
})
</script>

<template>
  <div class="carousel-wrapper">
    <div class="escrita-cima">
      <div class="escrita">
        <p>Propriedades em <span>Alta</span></p>
        <div class="button-circle"><i class="fa-solid fa-angle-right"></i></div>
      </div>

      <div class="arrows">
        <!-- SETA ESQUERDA -->
        <button ref="prevButton" class="custom-prev">
          <PhCaretLeft :size="32" />
        </button>

        <!-- SETA DIREITA -->
        <button ref="nextButton" class="custom-next">
          <PhCaretRight :size="32" />
        </button>
      </div>
    </div>

    <!-- CARROSSEL -->
    <Swiper
      :modules="[Navigation]"
      :space-between="24"
      :slides-per-view="1"
      :loop="true"
      :breakpoints="{
        // Telas médias (Tablets) - Aproximadamente 2 cards
        '768': {
          slidesPerView: 2.1,
          spaceBetween: 20,
        },
        // Telas Desktop (Laptops) - Aproximadamente 3 cards
        '1024': {
          slidesPerView: 2.4,
          spaceBetween: 24,
        },
        // Telas Grandes (Desktop Full HD) - Aproximadamente 3.5 a 4 cards
        '1440': {
          slidesPerView: 3.5,
          spaceBetween: 30,
        },
        // Telas Ultra-Wide
        '1920': {
          slidesPerView: 3.5,
          spaceBetween: 40,
        }
      }"
      @swiper="onSwiper"
      class="mySwiper"
    >per="onSwiper"
          class="mySwiper"
        >
      <SwiperSlide v-for="casa in properties" :key="casa.id">
        <CardEmAlta :casa="casa" />
      </SwiperSlide>
    </Swiper>

  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


.carousel-wrapper {
  position: relative;
  width: 100%;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.escrita-cima {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.escrita {
  display: flex;
  align-items: center;
  gap: 0.7rem;
}

.button-circle {
  height: 90%;
  aspect-ratio: 1/1;
  border-radius: 50%;
  background-color: var(--color-primary);
  font-size: 0.8rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  cursor: pointer;
  box-sizing: border-box;
  padding: 0.2rem;
}

p {
    position: relative;
    display: inline-block;
    font-size: 1.3rem;
    font-weight: 600;
}

p span {
  color: var(--color-primary);
}

p::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: -3px;
  height: 3px;
  width: 75%;
  background-color: var(--color-primary);
  border-radius: 15px;
}

p::after {
  content: '';
  position: absolute;
  right: 0;
  bottom: -3px;
  height: 3px;
  width: 20%;
  background-color: var(--color-primary);
  border-radius: 15px;
}

.arrows {
  display: flex;
  gap: 10px;
}

.mySwiper {
  width: 100%;
  border-radius: 16px;
  overflow-x: hidden;
  overflow-y: initial;
  padding: 1rem 0;
}

/* Escondendo as setas padrões do swiper */

.swiper-button-next::after,
.swiper-button-prev::after {
  display: none;
}

/* Novas setas */

.custom-prev,
.custom-next {
  z-index: 20;

  width: 29px;
  height: 29px;
  box-shadow: var(--shadow-sm);
  border: 0;
  border-radius: 50%;

  background: rgba(255, 255, 255, 0.7);
  color: rgb(0, 0, 0);

  font-size: 24px;
  cursor: pointer;

  transition: 0.3s;

  display: flex;
  align-items: center;
  justify-content: center;
}

.custom-prev:hover,
.custom-next:hover {
  box-shadow: var(--shadow-hover-blue);
}

.custom-prev {
  right: 50px;
}

.custom-next {
  right: 10px;
}

/* Colocando o fundo branco nas bolinhas */
:deep(.swiper-pagination-bullet) {
  background: #999;

  width: 10px;
  height: 10px;

  border-radius: 999px;

  transition: all 0.3s ease;
}

:deep(.swiper-pagination-bullet-active) {
  background: blue;

  width: 30px;
}

:deep(.swiper-pagination) {
  background: rgba(255, 255, 255, 0.95);

  width: fit-content;

  padding: 10px 16px;

  border-radius: 999px;

  left: 50% !important;
  transform: translateX(-50%);

  bottom: 10px !important;
}

:deep(.swiper-slide) {
  height: auto;
  box-sizing: border-box;
}
</style>
