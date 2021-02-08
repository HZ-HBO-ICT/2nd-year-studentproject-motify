import HueItem from './HueItem';

class Group extends HueItem {
    constructor(data) {
        super(data, 'groups');
        this.type = data.type;
        this.lights = data.lights;
        this.sensors = data.sensors;
        this.action = data.action;
        this.color = data.color;
        this.lightsRGB = data.lightsRGB;
    }
}

export default Group;
