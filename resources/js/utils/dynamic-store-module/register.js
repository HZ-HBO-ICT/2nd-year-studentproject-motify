import module from '@/store/modules/hue';

/**
 * ## Register Component With Dynamic Module
 * @description this service registers a new Vuex module for each model you want
 * @author Levi Deurloo <ldeurloo1@hz.nl>
 */
export default (name, store) => {
    store.registerModule(name, module);
}
