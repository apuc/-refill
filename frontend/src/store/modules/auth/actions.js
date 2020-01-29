import Axios from "axios";

const actions = {

    /**
     *
     * @param context
     * @returns {Promise<unknown>}
     * @constructor
     */
    LOG_IN_REQUEST: (context) => {
        return new Promise((resolve, reject) => {
            Axios.post('/api/login', context.getters.userData).then((response) => {
                if (response.status === 200) {
                    context.commit('SET_JWT_TOKEN', response.data.access_token);
                    resolve(true);
                }
            }).catch(error => {
                let responseStatus = error.response.status;
                if (responseStatus === 400) {
                    reject('Неверная почта или пароль.')
                } else {
                    reject('Ошибка авторизации.');
                }
            });
        });
    },
    LOG_OUT_REQUEST: (context) => {
        return new Promise((resolve, reject) => {
            Axios.post('/api/logout', {}).then(response => {
                if (response.status === 200) {
                    context.commit('REMOVE_USER_DATA');
                    resolve(true);
                }
            }).catch(error => {
                context.commit('REMOVE_USER_DATA');
                reject(error);
            });
        });
    },
};

export default actions;
