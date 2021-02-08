import Async from '@/utils/async';

const { postHue, putHue, removeHue } = Async;

class HueItem {
    /**
     * Set the name of this item
     *
     * @param   { object } data
     * @param   { string } groupName
     * @returns { string } name
     */
    constructor(data, groupName) {
        this.id = data.id;
        this.name = this.setName(data.name);
        this.groupName = groupName;
        this.state = this.setState(data.state);
    }

    /**
     * Set the name of this item
     *
     * @param   { string } name
     * @returns { string } name
     */
    setName(name) {
        if (name) return name;
        else if (name === 'new' || !name) return '';
        else return 'Foutmelding';
    }

    /**
     * Set the state of this item
     *
     * @param   { Object }       state
     * @returns { Object }       state
     */
    setState(state) {
        let stateObject = state ? state : { any_on: false, all_on: false };

        if (!stateObject.reachable) stateObject.reachable = true;

        return state;
    }

    /**
     * Create HueItem instance
     *
     * @param   { Object }      data
     * @returns { Promise<boolean> }
     */
    async create(data) {
        return await postHue(this.groupName, data);
    }

    /**
     * Update this HueItem instance
     *
     * @param   { Object }      state
     * @returns { Promise<boolean> }
     */
    async update(state) {
        return await putHue(this.groupName, this.id, state).then(() => {
            if (state.on !== null && this.groupName === 'groups') {
                this.state.all_on = state.on;
                this.state.any_on = state.on;
            }

            if (this.groupName === 'groups')
                this.action = { ...this.action, ...state };
            else this.state = { ...this.state, ...state };
        });
    }

    /**
     * Remove this HueItem instance
     *
     * @returns { Promise<boolean> }
     */
    async remove() {
        return await removeHue(this.groupName, this.id);
    }
}

export default HueItem;
