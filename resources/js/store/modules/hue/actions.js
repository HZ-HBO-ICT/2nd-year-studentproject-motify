import Bridge from '@/models/Bridge';
import Group from '@/models/Group';
import Light from '@/models/Light';
import types from './types';

/**
 * Get the model by type
 *
 * @param   { string }    type
 * @param   { Object }    item
 */
function generateObject(type, item) {
    switch (type) {
        case 'bridge':
            return new Bridge(item);
        case 'groups':
            return new Group(item);
        case 'lights':
            return new Light(item);
    }
}

/**
 * Initialize this store
 *
 * @param   { Object }
 * @param   { string }      type
 * @returns { Promise }
 */
const initialize = async ({ commit, state }, type) => {
    if (state.items.length === 0 && !state.loading) {
        commit(types.LOADING, { type: type });

        await fetch({ commit, state }, type, true);
    }
};

/**
 * Fetch all of this HueItems
 *
 * @param   { Object }
 * @param   { string }    type
 * @param   { Boolean }   init
 * @returns { Promise }
 */
const fetch = async ({ commit, state }, type, init = false) => {
    if (init || (state.items.length > 0 && !state.loading)) {
        try {
            await axios.get('hue/' + type).then(response => {
                const items = response.data;
                let itemModels = [];

                if (Array.isArray(items)) {
                    items.forEach(item => itemModels.push(generateObject(type, item)));
                    commit(types.SUCCESS, { items: itemModels, type: type });
                } else {
                    const item = generateObject(type, items);
                    commit(types.SUCCESS, { items: item, type: type });
                }
            });
        } catch (e) {
            throw e;
        }
    }
};

/**
 * Store a new HueItem
 *
 * @param   { Object }
 * @param   { Object }    value
 */
const store = async ({ commit, state }, value) => {
    commit(types.LOADING);

    const items = state.items.unshift(generateObject(type, value));
    commit(types.SUCCESS, { items: items, type: state.type });
};

/**
 * Update a new HueItem
 *
 * @param   { Object }
 * @param   { Object }    value
 */
const update = async ({ commit, state }, value) => {
    commit(types.LOADING);

    const items = [
        ...state.items.map(item =>
            item.id !== item.id ? item : { ...item, ...value },
        ),
    ];
    commit(types.SUCCESS, { items: items, type: state.type });
};

/**
 * Remove a new HueItem
 *
 * @param   { Object }
 * @param   { Object }    value
 */
const remove = async ({ commit, state }, value) => {
    commit(types.LOADING);

    const items = state.items.splice(state.items.indexOf(value), 1);
    commit(types.SUCCESS, { items: items, type: state.type });
};

export default {
    initialize,
    fetch,
    store,
    update,
    remove,
};
