<script setup lang="ts">
import TheBanner from '../components/TheBanner.vue'
import ProfileInfos from '../components/ProfileInfos.vue'
import ProfileBio from '../components/ProfileBio.vue'
import ProfileSocialLinks from '../components/ProfileSocialinfos.vue'
</script>

<template>
  <div class="page">
    <div class="page__header">
      <div class="title">
        <h1>Editar <span>Perfil</span></h1>
        <i class="fa-solid fa-user-pen"></i>
      </div>
      <svg
        class="page__settings"
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <circle cx="12" cy="12" r="3" />
        <path
          d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"
        />
      </svg>
    </div>

    <div class="page__body">
      <div class="page__left">
        <TheBanner />
        <ProfileBio />
      </div>

      <div class="page__right">
        <ProfileInfos />
        <ProfileSocialLinks />
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

.page {
  width: 100%;
  min-height: 100vh;
  padding: 2rem 0rem;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  background: var(--color-bg, #f4f6fb);
}

.page__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.title {
  align-self: flex-start;
  display: flex;
  gap: 10px;
  align-items: center;
  font-size: 1.3rem;
  color: var(--color-primary);
}

h1 {
  font-size: 1.3rem;
  font-weight: 600;
  position: relative;
  color: var(--color-black-text);
  margin: 0;
}

h1 span {
  color: var(--color-primary);
}

h1::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: -3px;
  height: 3px;
  width: 75%;
  background-color: var(--color-primary);
  border-radius: 15px;
}

h1::after {
  content: '';
  position: absolute;
  right: 0;
  bottom: -3px;
  height: 3px;
  width: 20%;
  background-color: var(--color-primary);
  border-radius: 15px;
}

.page__settings {
  cursor: pointer;
  color: #6b7280;
}

.page__body {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  align-items: start;
}

.page__left {
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

.page__right {
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

@media (max-width: 768px) {
  .page {
    padding: 1.5rem 1rem;
  }

  .page__body {
    grid-template-columns: 1fr;
  }
}
</style>
