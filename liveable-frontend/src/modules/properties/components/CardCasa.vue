<script setup lang="ts">
    import { PhHeart } from "@phosphor-icons/vue";
</script>


<template>
    <div class="card">
        <div class="cima">
            <div class="fav"><PhHeart weight="fill" class="icon-fav" :size="20" /></div>
        </div>
        <div class="baixo">
            <div class="textos">
                <p>Casa de Férias em Ubatuba</p>
                <div class="subtexto">
                    <p>R$300,00 p/noite</p>
                    <p>•</p>
                    <p>★ 5</p>
                </div>
            </div>

            <div class="button">
                <button>Ver Mais</button>
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
        background-color: white;
        height: 440px;
        border-radius: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.300);
    }

    .card .cima {
        width: 100%;
        height: 70%;
        background: url(https://img.freepik.com/fotos-gratis/foto-interior-bonita-de-uma-casa-moderna-com-paredes-brancas-relaxantes-moveis-e-tecnologia_181624-3828.jpg?semt=ais_hybrid&w=740&q=80);
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
        background-color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.300);
        transition: box-shadow 0.3s;
    }

    .fav:hover {
        box-shadow: 0 4px 10px rgba(16, 37, 226, 0.486);
    }

    .icon-fav {
        color: #D9D9D9;
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
        background-color: blue;
        color: white;
        transition: background-color 0.5s;
    }

    .button button:hover {
        background-color: rgb(0, 132, 255);
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