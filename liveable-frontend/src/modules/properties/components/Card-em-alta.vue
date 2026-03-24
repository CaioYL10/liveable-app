<script setup lang="ts">
    import { PhFire, PhArrowRight } from "@phosphor-icons/vue";
</script>

<template>
    <div class="all">
        <div class="informs">
            <div class="informs-texts">
                <h3>Casa de frente ao mar</h3>
                <p>R$300,00 p/ noites ★ 5</p>
                <p>
                    Mais de 70 mil cliques!
                    <PhFire :size="20" />
                </p>
            </div>

            <button>
                <PhArrowRight :size="32" />
            </button>
        </div>
    </div>
</template>

<style scoped>
    .all {
        width: 25vw;
        min-height: 350px;
        background-color: purple;
        border-radius: 22px;
        display: flex;
        align-items: flex-end;
    }

    .informs {
        width: 100%;
        min-height: 100px;
        background-color: rgb(12, 34, 236);
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
    }
</style>