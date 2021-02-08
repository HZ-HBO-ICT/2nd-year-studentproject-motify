export default {
    state: {
        projectRooms: [],
        projectRoom: {},
    },
    actions: {
        fetchProjectRooms({ commit }) {
            return axios.get('projectRooms').then((response) => {
                commit('setProjectRooms', response.data);
            });
        },
        fetchProjectRoom({ commit }, id) {
            return axios.get(`projectRooms/${id}`).then((response) => {
                commit('setProjectRoom', response.data);
            });
        },
        connectToProjectRoom({ commit }, code) {
            return axios.post(`projectRooms/connect`, { code });
        },
        disconnectFromProjectRoom({ commit }) {
            commit('setProjectRoom', {});
        },
    },
    getters: {
        getProjectRooms(state) {
            return state.projectRooms;
        },
        getProjectRoom(state) {
            return state.projectRoom;
        },
    },
    mutations: {
        setProjectRooms(state, projectRooms) {
            state.projectRooms = projectRooms;
        },
        setProjectRoom(state, projectRoom) {
            state.projectRoom = projectRoom;
        },
    },
};
