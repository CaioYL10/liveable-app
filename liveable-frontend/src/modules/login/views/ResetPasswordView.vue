<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route  = useRoute()
const router = useRouter()

const token                = ref('')
const email                = ref('')
const password             = ref('')
const passwordConfirmation = ref('')
const mensagem             = ref('')
const erro                 = ref('')
const enviando             = ref(false)

onMounted(() => {
  token.value = route.query.token as string ?? ''
  email.value = route.query.email as string ?? ''
})

async function resetar() {
  enviando.value = true
  erro.value     = ''
  mensagem.value = ''

  try {
    const res = await fetch('http://127.0.0.1:8000/api/reset-password', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({
        token:                 token.value,
        email:                 email.value,
        password:              password.value,
        password_confirmation: passwordConfirmation.value,
      }),
    })

    const data = await res.json()

    if (res.ok) {
      mensagem.value = data.message
      setTimeout(() => router.push('/baselogin'), 2000)
    } else {
      erro.value = data.message
    }
  } catch {
    erro.value = 'Erro ao conectar com o servidor.'
  } finally {
    enviando.value = false
  }
}
</script>

<template>
  <div class="container">
    <h1>Redefinir senha</h1>

    <input class="input-large input" type="password"
      placeholder="Nova senha" v-model="password" />
    <input class="input-large input" type="password"
      placeholder="Confirmar nova senha" v-model="passwordConfirmation" />

    <p v-if="mensagem" class="aviso ok">✅ {{ mensagem }}</p>
    <p v-if="erro"     class="aviso erro">⚠️ {{ erro }}</p>

    <button class="input-large button" @click="resetar" :disabled="enviando">
      {{ enviando ? 'Salvando...' : 'Redefinir senha' }}
    </button>
  </div>
</template>
