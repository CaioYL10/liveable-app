<script setup lang="ts">
import { ref } from 'vue'

import { Swiper, SwiperSlide } from 'swiper/vue'

import 'swiper/css'
import 'swiper/css/navigation'

import { Navigation } from 'swiper/modules'

import CardCasa from './CardCasa.vue'

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
</script>

<template>
  <div class="carousel-wrapper">
    <div class="escrita-cima">
      <p>Sugestões para Você</p>

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
      :slides-per-view="1"
      :space-between="24"
      :loop="true"
      :breakpoints="{
        480:  { slidesPerView: 1.2, spaceBetween: 16 },
        768:  { slidesPerView: 2.3, spaceBetween: 20 },
        1280: { slidesPerView: 3.5, spaceBetween: 24 },
        1600: { slidesPerView: 4.3, spaceBetween: 24 },
      }"
      @swiper="onSwiper"
      class="mySwiper"
    >
      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>

      <SwiperSlide>
        <CardCasa />
      </SwiperSlide>
    </Swiper>

  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


.carousel-wrapper {
  position: relative;
  width: 100%;
  padding: 0 3.5rem;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.escrita-cima {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.arrows {
  display: flex;
  gap: 10px;
}

.mySwiper {
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
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
