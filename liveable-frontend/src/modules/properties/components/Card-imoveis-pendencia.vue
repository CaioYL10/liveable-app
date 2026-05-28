<script setup lang="ts">
    import { PhHeart } from "@phosphor-icons/vue";
    import { onMounted } from "vue";
    import { ref } from "vue";
    import { useRouter } from 'vue-router';

    interface Property {
      title: string
      pricePerDay: number
      avaliation: number
      image: string
    }

    const property = ref<Property | null>(null)

      onMounted(async () => {
          try {
              const response = await fetch('http://127.0.0.1:8000/api/propertyCard')

              const data = await response.json()

              property.value = data

          } catch (error) {
              console.error(error)
          }
    })

    const router = useRouter()

    function goToDetails() {
      router.push('/property-details')
    }
</script>


<template>
    <div class="card">
        <div class="cima" :style="{ backgroundImage: `url(${property?.image})` }" @click="goToDetails">
            <div class="fav"><PhHeart weight="fill" class="icon-fav" :size="20" /></div>
        </div>
        <div class="baixo">
            <div class="textos">
                <p>{{ property?.title }}</p>
                <div class="subtexto">
                    <p>R${{property?.pricePerDay}} p/noite</p>
                    <p>•</p>
                    <p>★ {{ property?.avaliation }}</p>
                </div>
            </div>

            <div class="button">
                <button @click="goToDetails">Ver Mais</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .card {
        width: 20%;
        max-width: 320px;
        min-width: 300px;
        background-color: var(--color-bg-secondary);
        height: 440px;
        border-radius: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        box-shadow: var(--shadow-sm);
        color: var(--color-black-text);
    }

    .card .cima {
        width: 100%;
        height: 70%;
        background-repeat: no-repeat;
        background-size: 140% 100%;
        background-position: center;
        overflow: hidden;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 35px;
        border-bottom-right-radius: 35px;
        cursor: pointer;
        display: flex;
        justify-content: flex-end;
        align-items: start;
        padding: 13px 13px 0 0;
        box-sizing: border-box;
    }

    .cima .fav {
        width: 12%;
        height: 35px;
        aspect-ratio: 1 / 1;
        background-color: var(--color-bg);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: var(--shadow-sm);
        transition: box-shadow 0.3s;
    }

    .fav:hover {
        box-shadow: var(--shadow-hover-blue);
    }

    .icon-fav {
        color: var(--color-icon-inactive);
    }

    .card .baixo {
        width: 100%;
        height: 30%;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        box-sizing: border-box;
        padding: 20px;
        padding-top: 0;
        padding-bottom: 15px;
    }

    .baixo .button {
        align-self: center;
        width: 100%;
        height: 37px;
    }

    .button button {
        width: 100%;
        height: 100%;
        border-radius: 16px;
        cursor: pointer;
        border: 0;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        font-size: 14px;
        background-color: var(--color-primary);
        color: var(--color-primary-text);
        transition: background-color 0.5s;
    }

    .button button:hover {
        background-color: var(--color-primary-hover);
    }

    .baixo .textos {
        display: flex;
        flex-direction: column;
        text-align: start;
        gap: 3px;
        margin-top: 3%;
        white-space: nowrap;
        font-size: clamp(0.9rem, 1vw, 1.05rem);
    }

    .textos p {
        margin: 0;
    }

    .subtexto {
        font-size: 13px;
        opacity: 0.6;
        display: flex;
        gap: 10px;
        font-size: clamp(0.7rem, 0.81vw, 0.85rem);
    }


</style>
