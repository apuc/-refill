export default {

  //Для списка понадобится
  'SET_OPERATORS': (state, operators) => {
    state.operatorList = operators;
  },

  'SET_CURRENT_OPERATOR': (state, data) => {
    state.currentOperator.name = data.name;
    state.currentOperator.userLastRefill = data.userLastRefill;
    state.currentOperator.id = data.operatorId;
    state.currentOperator.userPhone = data.userPhone;
    state.currentOperator.userAmount = data.userAmount;
  },

  'SET_CURRENT_OPERATOR_PHONE': (state, userPhone) => {
    state.currentOperator.userPhone = userPhone;
  },

  'SET_CURRENT_OPERATOR_AMOUNT': (state, userAmount) => {
    state.currentOperator.userAmount = userAmount;
  },
};
