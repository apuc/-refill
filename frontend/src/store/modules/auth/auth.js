import actions from './actions';
import mutations from './mutations';
import getters from './getters';

const state = {
    userData: {
        email: "",
        password: "",
    },
    token: (!!localStorage.getItem('_jwt_token')) ? localStorage.getItem('_jwt_token') : '',
};

export default {
    state,
    mutations,
    getters,
    actions
};
