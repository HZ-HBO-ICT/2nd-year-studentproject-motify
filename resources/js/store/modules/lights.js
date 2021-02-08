import rgbToXy from '@/utils/colorConversion';

export default {
    state: {},
    actions: {
        async changeColorOfLights({ commit }, { red, green, blue }) {
            let xyArray = rgbToXy(red, green, blue);
            xyArray = [parseFloat(xyArray[0]), parseFloat(xyArray[1])];
            await axios.put('hue/lights/1/state', { xy: xyArray }).then(async () => {
                return await axios.put('hue/lights/2/state', { xy: xyArray });
            });
        },
    },
    getters: {},
    mutations: {},
};
