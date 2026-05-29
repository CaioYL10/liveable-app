<template>
  <div class="calendario-wrapper">
    <div class="calendario-header">
      <h2 class="titulo">Calendário</h2>
      <p class="subtitulo">Dias Solicitados <span>(Em preto)</span></p>
    </div>

    <div class="calendario-grid">
      <button class="nav-btn nav-prev" @click="mesAnterior" aria-label="Mês anterior">
        &#8249;
      </button>

      <!-- Mês 1 -->
      <div class="mes-card">
        <div class="mes-titulo">{{ nomeMes(mes1) }} {{ ano1 }}</div>
        <div class="dias-semana">
          <span v-for="d in DIAS_SEMANA" :key="d">{{ d }}</span>
        </div>
        <div class="dias-grid">
          <span
            v-for="(dia, i) in diasDoMes(mes1, ano1)"
            :key="'m1-' + i"
            class="dia"
            :class="classeDia(dia, mes1, ano1)"
            @click="dia && selecionarDia(dia, mes1, ano1)"
            @mouseenter="dia && hoverDia(dia, mes1, ano1)"
          >
            {{ dia || '' }}
          </span>
        </div>
      </div>

      <!-- Mês 2 -->
      <div class="mes-card">
        <div class="mes-titulo">{{ nomeMes(mes2) }} {{ ano2 }}</div>
        <div class="dias-semana">
          <span v-for="d in DIAS_SEMANA" :key="d">{{ d }}</span>
        </div>
        <div class="dias-grid">
          <span
            v-for="(dia, i) in diasDoMes(mes2, ano2)"
            :key="'m2-' + i"
            class="dia"
            :class="classeDia(dia, mes2, ano2)"
            @click="dia && selecionarDia(dia, mes2, ano2)"
            @mouseenter="dia && hoverDia(dia, mes2, ano2)"
          >
            {{ dia || '' }}
          </span>
        </div>
      </div>

      <button class="nav-btn nav-next" @click="proximoMes" aria-label="Próximo mês">
        &#8250;
      </button>
    </div>

    <!-- Resumo da seleção -->
    <div v-if="dataInicio" class="resumo">
      <div class="resumo-item">
        <span class="resumo-label">Check-in</span>
        <span class="resumo-valor">{{ formatarData(dataInicio) }}</span>
      </div>
      <div class="resumo-separador">→</div>
      <div class="resumo-item">
        <span class="resumo-label">Check-out</span>
        <span class="resumo-valor">{{ dataFim ? formatarData(dataFim) : '—' }}</span>
      </div>
      <div v-if="dataInicio && dataFim" class="resumo-item">
        <span class="resumo-label">Total</span>
        <span class="resumo-valor">{{ totalDias }} dias</span>
      </div>
      <button class="btn-limpar" @click="limpar">Limpar</button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'

// ─── Constantes ───────────────────────────────────────────────────────────────
// Ficam fora do componente pois nunca mudam — não precisam ser reativas
const DIAS_SEMANA = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'] as const

const NOMES_MESES = [
  'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
  'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro',
] as const

// ─── Estado reativo ────────────────────────────────────────────────────────────
// ref<Tipo>(valorInicial) — o .value é obrigatório no script, mas não no template
const hoje    = new Date()
const mesBase = ref<number>(hoje.getMonth())    // 0=Jan ... 11=Dez
const anoBase = ref<number>(hoje.getFullYear())
const dataInicio = ref<Date | null>(null)
const dataFim    = ref<Date | null>(null)
const hoverDate  = ref<Date | null>(null)

// ─── Computed ─────────────────────────────────────────────────────────────────
// Se recalculam automaticamente toda vez que mesBase ou anoBase mudam
const mes1 = computed<number>(() => mesBase.value % 12)
const ano1 = computed<number>(() => anoBase.value + Math.floor(mesBase.value / 12))

const mes2 = computed<number>(() => (mesBase.value + 1) % 12)
const ano2 = computed<number>(() => anoBase.value + Math.floor((mesBase.value + 1) / 12))

const totalDias = computed<number>(() => {
  if (!dataInicio.value || !dataFim.value) return 0
  const diff = dataFim.value.getTime() - dataInicio.value.getTime()
  return Math.round(diff / (1000 * 60 * 60 * 24))
})

// ─── Funções ──────────────────────────────────────────────────────────────────
function mesAnterior(): void {
  mesBase.value--
}

function proximoMes(): void {
  mesBase.value++
}

function nomeMes(mes: number): string {
  return NOMES_MESES[mes] ?? ''
}

// Retorna array com os dias — null nos espaços vazios antes do dia 1
function diasDoMes(mes: number, ano: number): (number | null)[] {
  const primeiroDia      = new Date(ano, mes, 1).getDay()        // 0=Dom, 6=Sab
  const totalDiasNoMes   = new Date(ano, mes + 1, 0).getDate()   // último dia do mês
  const dias: (number | null)[] = []

  for (let i = 0; i < primeiroDia; i++) dias.push(null) // espaços em branco
  for (let d = 1; d <= totalDiasNoMes; d++) dias.push(d)

  return dias
}

function toDate(dia: number, mes: number, ano: number): Date {
  return new Date(ano, mes, dia)
}

function selecionarDia(dia: number, mes: number, ano: number): void {
  const data = toDate(dia, mes, ano)

  // 1º clique (ou reiniciando seleção): define só o início
  if (!dataInicio.value || (dataInicio.value && dataFim.value)) {
    dataInicio.value = data
    dataFim.value    = null
    hoverDate.value  = null
    return
  }

  // 2º clique: define o fim — garante que início < fim
  if (data < dataInicio.value) {
    dataFim.value    = dataInicio.value
    dataInicio.value = data
  } else {
    dataFim.value = data
  }
  hoverDate.value = null
}

function hoverDia(dia: number, mes: number, ano: number): void {
  // Só mostra preview se já tem início mas ainda não tem fim
  if (dataInicio.value && !dataFim.value) {
    hoverDate.value = toDate(dia, mes, ano)
  }
}

function classeDia(dia: number | null, mes: number, ano: number): string | string[] {
  if (!dia) return 'vazio'

  const data   = toDate(dia, mes, ano)
  const inicio = dataInicio.value
  const fim    = dataFim.value ?? hoverDate.value  // ?? = "se null, usa o próximo"

  const eInicio     = !!inicio && data.getTime() === inicio.getTime()
  const eFim        = !!fim    && data.getTime() === fim.getTime()
  const noIntervalo = !!inicio && !!fim && data > inicio && data < fim

  const classes: string[] = []

  if (eInicio)                                   classes.push('inicio')
  if (eFim && dataFim.value)                     classes.push('fim')
  if (eFim && !dataFim.value && hoverDate.value) classes.push('hover-fim')
  if (noIntervalo)                               classes.push('no-intervalo')
  if (eInicio || (eFim && dataFim.value))        classes.push('selecionado')

  return classes
}

function formatarData(date: Date): string {
  return date.toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
  })
}

function limpar(): void {
  dataInicio.value = null
  dataFim.value    = null
  hoverDate.value  = null
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* { box-sizing: border-box; }

.calendario-wrapper {
  min-width: 100%;
  user-select: none;
  font-family: "Poppins", sans-serif;
}

.titulo {
  font-size: 22px;
  font-weight: 700;
  font-family: "Poppins", sans-serif;
  margin: 0 0 2px;
  color: #111;
}

.subtitulo {
  opacity: 0.6;
  font-weight: 500;
  font-family: "Poppins", sans-serif;
  margin: 0 0 24px;
}
.subtitulo span { color: #333; font-weight: 500; }

.calendario-grid {
  display: grid;
  grid-template-columns: auto 1fr 1fr auto;
  gap: 16px;
  align-items: start;
}

.nav-btn {
  background: none;
  border: 1px solid #e0e0e0;
  border-radius: 50%;
  width: 34px;
  height: 34px;
  font-size: 20px;
  cursor: pointer;
  color: #444;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 4px;
  transition: background 0.15s;
}
.nav-btn:hover { background: #f5f5f5; }

.mes-card {
  background: #fff;
  border: 1px solid #e8e8e8;
  border-radius: 14px;
  padding: 16px;
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
}

.mes-titulo {
  text-align: center;
  font-weight: 600;
  font-size: 14px;
  color: #111;
  margin-bottom: 14px;
  letter-spacing: 0.01em;
}

.dias-semana {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  margin-bottom: 6px;
}
.dias-semana span {
  text-align: center;
  font-size: 11px;
  font-weight: 600;
  color: #aaa;
  padding: 2px 0;
  letter-spacing: 0.03em;
}

.dias-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 2px;
}

.dia {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 34px;
  font-size: 13px;
  font-weight: 400;
  color: #222;
  cursor: pointer;
  border-radius: 50%;
  transition: background 0.1s, color 0.1s;
  z-index: 1;
}

.dia:hover:not(.vazio):not(.selecionado):not(.no-intervalo) {
  background: #f0f0f0;
}

.dia.vazio { cursor: default; }

.dia.no-intervalo {
  background: #1a1a1a;
  color: #fff;
  border-radius: 0;
}

.dia.selecionado {
  background: #111 !important;
  color: #fff !important;
  border-radius: 50% !important;
  font-weight: 600;
}

.dia.hover-fim {
  background: #555;
  color: #fff;
  border-radius: 50%;
}

.dia.inicio {
  background: #111;
  color: #fff;
  border-radius: 50% 0 0 50%;
}
.dia.fim {
  background: #111;
  color: #fff;
  border-radius: 0 50% 50% 0;
}
.dia.inicio.fim,
.dia.selecionado:not(.no-intervalo) {
  border-radius: 50% !important;
}

.resumo {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-top: 20px;
  background: #f8f8f8;
  border: 1px solid #e8e8e8;
  border-radius: 12px;
  padding: 14px 20px;
  flex-wrap: wrap;
}
.resumo-item {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.resumo-label {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: #999;
}
.resumo-valor {
  font-size: 14px;
  font-weight: 500;
  color: #111;
}
.resumo-separador {
  font-size: 18px;
  color: #ccc;
}
.btn-limpar {
  margin-left: auto;
  background: none;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 6px 14px;
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  color: #666;
  transition: background 0.15s;
}
.btn-limpar:hover { background: #eee; }
</style>
