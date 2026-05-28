<template>
  <div class="container">
    <h1>Bem-vindo de volta!</h1>
    <h2>Ainda não tem uma conta? <span>Cadastrar-se</span></h2>
    <input class="input-large input" type="text" placeholder="Email">

    <div class="input-password">
      <input class="input-large input" type="text" placeholder="Senha">
      <a href="">Esqueceu sua senha?</a>
    </div>

    <div class="save-informations-text">
      <input type="checkbox">
      <p>Salvar informações de login!</p>
    </div>

    <button class="input-large button">Entrar</button>

    <div class="divisoria">
      <div class="risc"></div>
      <p>Ou entrar com</p>
      <div class="risc"></div>
    </div>

    <div class="social-medias">
      <button><i class="fa-brands fa-google"></i></button>
      <button><i class="fa-brands fa-square-facebook"></i></button>
      <button><i class="fa-brands fa-x-twitter"></i></button>
    </div>
  </div>
</template>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  * {
    margin: 0;
    padding: 0;
  }

  .container {
    display: flex;
    flex-direction: column;
    min-width: 40%;
    font-family: "Poppins", sans-serif;
    justify-content: center;
    gap: 2vw;
  }

  button, input {
    font-family: "Poppins", sans-serif;
  }

  button {
    cursor: pointer;
  }

  .button {
    background-color: var(--color-primary);
    color: white;
    transition: background-color 0.5s;
  }

  .button:hover {
    background-color: var(--color-primary-hover);
  }

  .container h2 {
    font-size: 1.3rem;
    opacity: 0.6;
  }

  .container h2 span {
    opacity: 1;
    color: var(--color-primary);
    cursor: pointer;
    text-decoration: underline;
  }

  .container .input-large {
    width: 100%;
    padding: 0.8rem 0;
    border-radius: 0.5rem;
    border: 0;
  }

  .container .input {
    box-sizing: border-box;
    padding-left: 1rem;
    border: 1px solid black;
  }

  .input-password {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .input-password a {
    align-self: flex-end;
  }

  .save-informations-text {
    display: flex;
    gap: 10px;
  }

  .save-informations-text input {
    width: 17px;
  }

  .divisoria {
    display: flex;
    align-items: center;
  }

  .divisoria p {
    padding: 0 1rem;
    text-wrap: nowrap;
  }

  .risc {
    width: 100%;
    background-color: black;
    height: 2px;
  }

  .social-medias {
    width: 100%;
    display: flex;
    justify-content: space-between;
    gap: 1rem;
  }

  .social-medias button {
    width: 100%;
    padding: 0.3rem 0;
  }
</style>
