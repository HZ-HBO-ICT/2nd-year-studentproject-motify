import HueItem from './HueItem';

class Light extends HueItem {
    constructor(data) {
        super(data, 'lights');
        this.type = data.type || String;
        this.swUpdate = data.swupdate || Object;
        this.modelID = data.modelid || String;
        this.config = data.config;
        this.capabilities = data.capabilities;
        this.productName = data.productname || String;
        this.color = data.color || null;
    }
}

export default Light;
