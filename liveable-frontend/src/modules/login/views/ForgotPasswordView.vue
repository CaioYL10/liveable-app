<script setup lang="ts">
import { ref } from 'vue'

const email    = ref('')
const mensagem = ref('')
const erro     = ref('')
const enviando = ref(false)

async function enviar() {
  enviando.value = true
  erro.value     = ''
  mensagem.value = ''

  try {
    const res = await fetch('http://127.0.0.1:8000/api/forgot-password', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({ email: email.value }),
    })

    const data = await res.json()
    if (res.ok) mensagem.value = data.message
    else        erro.value     = data.message
  } catch {
    erro.value = 'Erro ao conectar com o servidor.'
  } finally {
    enviando.value = false
  }
}
</script>

<template>
  <div class="container">
    <h1>Esqueci minha senha</h1>
    <p class="sub">Digite seu email e enviaremos um link para redefinir sua senha.</p>

    <input class="input-large input" type="email" placeholder="Email" v-model="email" />

    <p v-if="mensagem" class="aviso ok">✅ {{ mensagem }}</p>
    <p v-if="erro"     class="aviso erro">⚠️ {{ erro }}</p>

    <button class="input-large button" @click="enviar" :disabled="enviando">
      {{ enviando ? 'Enviando...' : 'Enviar link' }}
    </button>
  </div>
</template>
