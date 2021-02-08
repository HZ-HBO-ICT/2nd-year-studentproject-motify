export default {
    actions: {
        register({ commit }, credentials) {
            return axios.post('auth/register', credentials);
        },
    },
};
