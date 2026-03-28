<script setup lang="ts">
    import { PhFire, PhArrowRight } from "@phosphor-icons/vue";
</script>

<template>
    <div class="all">
        <div class="informs">
            <div class="informs-texts">
                <h3>Casa de frente ao mar</h3>
                <div class="subs">
                    <p class="subtitle opacity">R$300,00 p/ noites • ★ 5</p>
                    <p class="subtitle">
                        Mais de 70 mil cliques!
                        <PhFire weight="fill" class="fire" :size="15" />
                    </p>
                </div>
            </div>

            <button>
                <PhArrowRight weight="bold" :size="26" />
            </button>
        </div>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .all {
        width: clamp(25rem, 25vw, 40rem);
        min-height: 350px;
        border-radius: 30px;
        display: flex;
        align-items: flex-end;
        contain: paint;
        font-family: "Poppins", sans-serif;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.300);
        color: var(--color-primary-text);
        background-image: url(https://italicohomes.com/wp-content/uploads/2024/01/interiores-casa-moderna-13.jpg);
        background-size: cover;
        background-position: center;
    }

    .informs {
        width: 100%;
        min-height: 120px;
        background: var(--color-overlay); 
        backdrop-filter: blur(2px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        padding: 0 25px;
        align-items: center;
        border-radius: 22px;
    }

    .informs-texts {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 18px;
    }

    .informs-texts p, h3 {
        margin: 0;
    }

    .informs-texts .fire {
        color: var(--color-primary);
    }

    .subs {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .subtitle {
        font-size: 14px;
        font-weight: 700;
    }

    button {
        width: 4rem; 
        max-height: 4rem;
        aspect-ratio: 1 / 1; 
        border-radius: 50%;
        border: none;
        cursor: pointer;
        background-color: var(--color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-primary-text);
        transition: background-color 0.5s;
    }

    button:hover {
        background-color: var(--color-primary-hover);
    }


    .opacity {
        opacity: 0.7;
        font-weight: 600;
    }
</style>