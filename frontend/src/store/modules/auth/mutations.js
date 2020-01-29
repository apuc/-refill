import axios from "axios";

const mutations = {
    SET_JWT_TOKEN: (state, token) => {
        localStorage.setItem('_jwt_token', token);
        state.token = token;
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    },

    SET_USER: (state, data) => {
        state.userData.email = data.email;
        state.userData.password = data.password;
    },
    SET_USER_EMAIL: (state, email) => {
        state.userData.email = email;
    },
    SET_USER_PASSWORD: (state, pass) => {
        state.userData.password = pass;
    },
    REMOVE_USER_DATA: state => {
        localStorage.clear();
        state.token = '';
        state.userData = {
            email: "",
            password: "",
        }
    },
}

export default mutations;
