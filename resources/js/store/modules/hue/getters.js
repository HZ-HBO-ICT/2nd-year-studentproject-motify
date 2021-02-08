// TODO: write JSDocs
const getItems = state => {
    return state.items;
};

const getType = state => {
    return state.type;
};

const getByID = state => id => {
    return state.items.find(item => item.id === +id);
};

export default {
    getItems,
    getType,
    getByID,
};
