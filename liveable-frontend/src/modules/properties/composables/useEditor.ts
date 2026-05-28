import { ref } from "vue";

export const exibir = ref<boolean>(false);

export function exibirEditor() {
  exibir.value = !exibir.value;
}
