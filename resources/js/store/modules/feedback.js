export default {
    state: {
        feedback: []
    },
    actions: {
        fetchFeedback({ commit }) {
            return axios.get('feedback').then((response) => {
                commit('setFeedback', response.data);
            });
        },
        storeFeedback({ commit }, data) {
            return axios.post(`feedback/store`, data);
        },
    },
    getters: {
        getFeedback(state) {
            return state.feedback
        }
    },
    mutations: {
        setFeedback(state, feedback) {
            state.feedback = feedback;
        },
    },
};
