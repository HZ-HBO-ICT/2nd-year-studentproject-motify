import HueItem from './HueItem';

export default class Sensor extends HueItem {
    constructor(data) {
        super(data, 'sensors');
        this.id = data.id;
        this.config = data.config;
    }
}
