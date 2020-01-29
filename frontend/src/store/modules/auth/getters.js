const getters = {
    getJwtToken: state => state.token,
    isAuth: state => !!state.token,
    userData: state => state.userData,
};

export default getters;
