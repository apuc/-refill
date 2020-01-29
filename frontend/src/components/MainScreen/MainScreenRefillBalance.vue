<template>
    <div class="refill">

        <header>
            <h2>Refill your balance</h2>
        </header>

        <router-link to="/" class="back-btn">
            <p>Back</p>
        </router-link>

        <div class="refill_form">

            <div class="refill_form_selected-operator">

                <div class="refill_form_selected-operator_info">
                    <div class="operator-block_logo">
                        <!--						<img src="@/assets/img/MTS.png" :alt="currentOperator.name">-->
                    </div>
                    <p>{{currentOperator.name}}</p>
                </div>

                <div class="refill_form_selected-operator_balance">
                    <p>Last refill:</p>
                    <div>
                        <div>Phone: {{currentOperator.userLastRefill.phone}}</div>
                        <div>Amount: {{currentOperator.userLastRefill.amount}}$</div>
                    </div>
                </div>
            </div>

            <div class="refill_form_input form-block">
                <label for="phoneNumber">Phone number:</label>
                <the-mask id="phoneNumber" :mask="['# (###) ###-##-##']" v-model="userPhone"/>
<!--                <small class="error-validate" v-if="phoneError">{{ phoneError }}</small>-->
                <small v-for="error in phoneError" class="error-validate" v-if="error">{{ error }}</small>
            </div>

            <div class="refill_form_input form-block">
                <label for="amount">Amount:</label>
                <input type="text" id="amount"
                       required
                       :value="currentOperator.userAmount"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       @input="SET_CURRENT_OPERATOR_AMOUNT($event.target.value)">
                <small v-for="error in amountError" class="error-validate" v-if="error">{{ error }}</small>
            </div>

            <button class="form-btn" @click="submit()">
                Submit
            </button>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapMutations} from 'vuex';

    export default {
        name: 'MainScreen',
        beforeMount() {
            if (!(!!this.currentOperator.id)) {
                this.$router.push({path: "/"});
            }
        },

        data() {
            return {
                phoneError: [],
                amountError: [],
            }
        },

        computed: {
            ...mapGetters('terminal', ['currentOperator']),
            userPhone: {
                set(value){
                    this.$store.commit('terminal/SET_CURRENT_OPERATOR_PHONE', value);
                },
                get(){
                    return this.$store.getters['terminal/currentOperator'].userPhone;
                }
            }
        },
        methods: {
            ...mapMutations({
                SET_USER: "auth/SET_USER",
                SET_CURRENT_OPERATOR: "terminal/SET_CURRENT_OPERATOR",
                SET_CURRENT_OPERATOR_PHONE: "terminal/SET_CURRENT_OPERATOR_PHONE",
                SET_CURRENT_OPERATOR_AMOUNT: "terminal/SET_CURRENT_OPERATOR_AMOUNT",
            }),
            submit() {
                if (this.validate()) {
                    this.$store.dispatch('terminal/REFILL_OPERATOR_REQUEST').then(response => {
                        this.SET_CURRENT_OPERATOR({
                            name: "",
                            logo: "",
                            userLastRefill: {},
                            userPhone: "",
                            userAmount: ""
                        });
                        this.$router.push({path: "/"});
                    }).catch(error => {
                        alert(error);
                    })
                }else{
                    setTimeout(() => {
                        this.phoneError = [];
                        this.amountError = [];
                    }, 3000)
                }
            },
            validate() {
                this.phoneError = [];
                this.amountError = [];
                let noError = true;
                //phone validate
                const compiledPattern = new RegExp("^((/+7|7|8)+([0-9]){10})$", 'i');
                const match = (!!this.currentOperator.userPhone) ? this.currentOperator.userPhone.match(compiledPattern) : null;
                if (match === null) {
                    noError = false;
                    this.phoneError.push('Wrong phone format.');
                }

                //amount validate
                if(!(!!this.currentOperator.userAmount)){
                    noError = false;
                    this.amountError.push('Required filed');
                }else if((this.currentOperator.userAmount > 1000)){
                    noError = false;
                    this.amountError.push('Max value - 1000');
                }else if ((this.currentOperator.userAmount < 1)){
                    noError = false;
                    this.amountError.push('Min value - 1');
                }
                return noError;
            }
        },
    }
</script>

<style scoped lang="scss">
    .error-validate {
        color: red;
    }

    .refill {
        display: grid;
        grid-template-columns: auto 100px;
        grid-row-gap: 10px;

        header {
            text-align: center;
        }

        &_form {
            grid-column: 1/3;
            display: grid;
            grid-template-columns: 1fr 2.5fr;
            grid-gap: 10px;

            &_selected-operator {
                grid-column: 1/2;
                grid-row: 1/3;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                text-align: center;
                font-weight: 600;

                &_info {
                    margin: auto;
                    padding: 5px;
                    position: relative;
                    border: 2px solid $primaryColor;
                    border-radius: 15px;

                    &_logo {
                        position: relative;
                        display: flex;
                        height: 80px;

                        img {
                            margin: auto;
                            max-width: 100%;
                            max-height: 100%;
                        }
                    }
                }

                &_balance {
                    margin-top: 10px;
                }
            }

            &_input {
                margin: auto 0;
            }

            button {
                grid-column: 1/3;
                margin: 0 auto;
            }

            @media($phone) {
                grid-template-columns: 1fr;
                &_selected-operator {
                    grid-column: 1/2;
                    grid-row: 1/2;
                    flex-direction: row;
                    justify-content: center;

                    &_balance {
                        margin: auto;
                    }
                }
                button {
                    grid-column: 1/2;
                }
            }
        }
    }

</style>
