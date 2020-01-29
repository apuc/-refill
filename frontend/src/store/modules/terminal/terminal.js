import getters from './getters';
import actions from './actions';
import mutations from './mutations';

const state = {
  currentOperator:{
    name: "",
    userLastRefill: {},
    userPhone: "",
    userAmount: ""
  },
  operatorList:[
  ],
};

export default {
  state,
  getters,
  actions,
  mutations,
};
