import types from './types';

const success = function(state, obj) {
    state.items = obj.items;
    state.type = obj.type;
    state.loading = false;
};

const loading = function(state, obj) {
    state.type = obj.type;
    state.loading = true;
};

export default {
    [types.SUCCESS]: success,
    [types.LOADING]: loading,
};
