<template>
    <div>
        <header>
            <h2>Select your telecom operator:</h2>
        </header>
        <div class="main-screen_list">

            <div class="main-screen_list_elem operator-block"
                 v-for="item in operatorList"
                 @click="selectOperator(item)">
                <div class="operator-block_logo">
<!--                    <img src="@/assets/img/MTS.png" :alt="item.name">-->
                </div>
                <p>{{item.name}}</p>
            </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters, mapMutations} from 'vuex';

    export default {
        name: 'MainScreenList',
        created() {
            //Получить список операторов от сервера
            this.$store.dispatch('terminal/ALL_OPERATORS_REQUEST');
        },
        computed: {
            ...mapGetters('terminal', ['operatorList']),
        },
        methods: {
            ...mapMutations({
                SET_CURRENT_OPERATOR: "terminal/SET_CURRENT_OPERATOR",
                SET_OPERATORS: "terminal/SET_OPERATORS"
            }),
            selectOperator(data) {
                this.$store.dispatch('terminal/CURRENT_OPERATOR_REQUEST', data).then(response => {
                    this.$router.push({path: "/refill"});
                });
                // this.SET_CURRENT_OPERATOR({
                //     name: data.name,
                //     logo: data.logo,
                //     userBalance: data.userBalance,
                // });
            }
        },
    }
</script>

<style scoped lang="scss">
    .main-screen {
        header {
            text-align: center;
        }

        &_list {
            max-height: 80vh;
            overflow-y: auto;
            padding: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            flex-wrap: wrap;
            align-content: center;

            &_elem {
                padding: 5px;
                margin: 5px;
                position: relative;
                max-width: 120px;
                border: 2px solid $primaryColor;
                border-radius: 15px;
                background-color: darken($alterColor, 5%);
                transition-duration: 0.5s;
                cursor: pointer;

                &:hover {
                    background-color: lighten($alterColor, 5%);
                }
            }
        }
    }
</style>
