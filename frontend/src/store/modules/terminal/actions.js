import Axios from "axios";

const actions = {

    ALL_OPERATORS_REQUEST: (context) => {
        return new Promise((resolve, reject) => {
            Axios.get('/api/providers').then((response) => {
                context.commit('SET_OPERATORS', response.data);
                resolve(true);
            }).catch(error => {
                reject('Ошибка.');
            });
        });
    },
    CURRENT_OPERATOR_REQUEST: (context, data) => {
        return new Promise( (resolve, reject) => {
           Axios.get('/api/replenish/' + data.id).then(response => {
               context.commit('SET_CURRENT_OPERATOR', {
                   name: data.name,
                   operatorId: data.id,
                   userLastRefill: response.data,
               });
               resolve(true);
           }).catch(error => {
                reject(error);
           });
        });
    },
    REFILL_OPERATOR_REQUEST: (context) => {
        let data = context.getters.currentOperator;
        return new Promise( (resolve, reject) => {
            Axios.post('/api/replenish/' + data.id, {
                amount: data.userAmount,
                phone: data.userPhone
            }).then(response => {
                resolve(true);
            }).catch(error => {
                reject(error);
            })
        });
    },
};

export default actions;
