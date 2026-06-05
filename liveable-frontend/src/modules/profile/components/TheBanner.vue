<script setup lang="ts">
import { onMounted, ref } from "vue";
import { getUser } from "@/services/auth";

const user = ref<any>(null);

onMounted(async () => {
  try {
    user.value = await getUser();
  } catch (error) {
    console.error("Erro ao buscar usuário", error);
  }
});
</script>


<template>
    <div class="all">
        <div class="banner"></div>
        <div class="profile-image">
        </div>

        <div class="padding">
            <div class="inform-texts">
                <p class="title">Aparência de Perfil - <span v-if="user">{{ user.name }} {{ user.last_name }}</span></p>
                <p class="subtitle">Está foto é mostrada públicamente à outros usuários.</p>
            </div>

            <div class="confirm-buttons">
                <button class="button-new-photo">Nova Foto</button>
                <button class="button-save">Salvar</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .all {
        width: 35%;
        height: auto;
        display: flex;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        gap: 1rem;
        position: relative;
        border-radius: 25px;
        contain: paint;
        box-shadow: var(--shadow-sm);
    }

    .banner {
        width: 100%;
        height: 150px;
        background-color: purple;
        border-radius: 25px;
        background-image: url(https://media.licdn.com/dms/image/v2/C4E16AQEZ1SaQMeBB1Q/profile-displaybackgroundimage-shrink_200_800/profile-displaybackgroundimage-shrink_200_800/0/1580959569592?e=2147483647&v=beta&t=8N_9T55vn71ZwKNMEeF0QnktAqCyFSxVNvuH8KdU1qs);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .profile-image {
        width: clamp(7rem, 18%, 20rem);
        height: auto;
        aspect-ratio: 1/1;
        background-image: url(https://fastcompanybrasil.com/wp-content/uploads/2025/05/quer-ser-mais-feliz-confira-5habitos-para-adotar-ainda-hoje.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: absolute;
        transform: translateY(-50%);
        top: 150px; /* altura do banner */
        left: 28px;
        border-radius: 20px;
    }

    .inform-texts {
        width: 100%;
        height: auto;
        margin-top: 4.8rem; /* ajusta conforme o tamanho da imagem */
    }

    .inform-texts .title {
        font-size: 22px;
        font-size: clamp(1rem, 1.2rem + 0.2vw, 2rem);
        margin: 0;
    }

    .inform-texts .subtitle {
        font-size: 18px;
        font-size: clamp(0.6rem, 0.7rem + 0.3vw, 1.2rem);
        margin: 0;
        opacity: 0.6;
    }

    .confirm-buttons {
        width: 100%;
        height: auto;
        display: flex;
        gap: 10px;
        margin-bottom: 1.6rem;
    }

    .confirm-buttons button {
        width: 120px;
        width: clamp(120px, 20%, 200px);
        padding: 13px 0;
        cursor: pointer;
        border-radius: 10px;
        border: none;
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        transition: background-color 0.5s;
    }

    .button-new-photo {
        outline: 0.5px solid var(--color-primary);
        color: var(--color-primary);
        background-color: transparent;
    }

    .button-new-photo:hover {
        background-color: var(--color-primary);
        outline: 0;
        color: var(--color-primary-text);
    }

    .button-save {
        background-color: var(--color-primary);
        color: var(--color-primary-text);
    }

    .button-save:hover {
        background-color: var(--color-primary-hover);
    }

    .padding {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
        gap: 1.5rem;
        box-sizing: border-box;
        padding: 0 1.7rem;
    }


    @media (max-width: 768px) {
    .all {
        aspect-ratio: auto;
        min-height: auto;
        width: 95%;
        margin: 0 auto;
    }
    }
</style>