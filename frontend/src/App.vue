<template>
    <div id="app">
        <div class="topnav">
            <router-link class="href" v-if="!isAuth" to="/login">Login</router-link>
            <router-link class="href" v-else to="/logout">Logout</router-link>
            <router-link class="href" to="/">main</router-link>
            <router-link class="href" to="/refill">refill</router-link>
        </div>
        <router-view/>
    </div>
</template>

<script>
    export default {
        computed: {
            isAuth() {
                return this.$store.getters['auth/isAuth'];
            }
        }
    }
</script>


<style lang="scss">

    /* Add a black background color to the top navigation */
    .topnav {
        background-color: #333;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav .href {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #5c6add;
        color: black;
    }

    /* Add a color to the active/current link */
    .topnav .router-link-exact-active {
        background-color: #5124af;
        color: white;
    }


    //Для избавления от стандартных браузерных отступов
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    #app {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        font-family: $primaryFont;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: $primaryColor;
        background-color: darken($alterColor, 5%);

        .main {
            position: relative;
            margin: auto;
            padding: 10px;
            display: block;
            height: auto;
            min-width: 500px;
            max-width: 900px;
            border-radius: 30px;
            background-color: $alterColor;
            border: 3px solid $primaryColor;
            @media ($phone) {
                min-width: 90vw;
            }
        }
    }

    //Логотип + имя оператора
    .operator-block {
        background-color: aliceblue;
        display: flex;
        flex-direction: column;
        justify-content: center;
        max-height: 100%;

        &_logo {
            position: relative;
            width: 100%;

            img {
                display: block;
                max-width: 100%;
            }
        }

        p {
            text-align: center;
            text-transform: uppercase;
            font-weight: 600;
        }
    }

    //Общее оформление инпутов
    .form-block {
        display: grid;
        grid-template-columns: 1.5fr 3fr;
        font-weight: 600;

        label {
            margin: auto 0;
        }

        input {
            margin: auto 0;
            height: 30px;
            padding: 0 10px;
            font-family: $primaryFont;
            font-weight: 600;
            border-radius: 5px;
            background-color: darken($alterColor, 5%);
            border: 2px solid fade-out($primaryColor, 0.3);
            transition-duration: 0.2s;

            &:hover {
                background-color: $alterColor;
                border: 2px solid $primaryColor;
            }

            &:focus {
                border: 2px solid $secondaryColor;
                color: $secondaryColor;
            }
        }

        @media ($phone) {
            grid-template-columns: 1fr;
            grid-row-gap: 5px;
        }
    }

    //Общее оформление главной кнопки
    .form-btn {
        display: block;
        width: 150px;
        height: 40px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        color: $alterColor;
        border: none;
        border-radius: 5px;
        background-color: $secondaryColor;
        transition-duration: 0.3s;

        &:hover {
            cursor: pointer;
            background-color: lighten($secondaryColor, 10%);
        }

        &:active {
            background-color: darken($secondaryColor, 10%);
        }
    }

    //Общее оформление кнопки "назад""
    .back-btn {
        display: flex;
        width: 80px;
        height: 30px;
        color: $alterColor;
        font-weight: 600;
        text-decoration: none;
        border-radius: 5px;
        background-color: $secondaryColor;

        p {
            margin: auto;
        }
    }

</style>
