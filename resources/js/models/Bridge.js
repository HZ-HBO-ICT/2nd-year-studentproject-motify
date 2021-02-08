export class Bridge {
    constructor(data) {
        this.id = data.id;
        this.name = data.name;
        this.zigbeechannel = data.zigbeechannel || 0;
    }
}

export default Bridge;
