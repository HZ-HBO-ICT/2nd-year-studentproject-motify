/**
 * Create a specific type Hue Item
 *
 * @param { string } type
 * @param { object } request
 *
 * @return { Promise<boolean> }
 */
async function postHue(type, request) {
    return await axios.post('hue/' + type + '/', request);
}

/**
 * Get the type, state for all HueItems except GroupTs
 *
 * @param { string } type
 * @param { number } id
 *
 * @returns { string }
 */
function getStateOrAction(type, id) {
    if (type === 'groups') return 'hue/' + type + '/' + id + '/action';
    else return 'hue/' + type + '/' + id + '/state';
}

/**
 * Put a Hue state for a specific type
 *
 * @param { string } type
 * @param { number } id
 * @param { object } request
 * @param { object } state
 *
 * @return { Promise<boolean> }
 */
async function putHue(type, id, request, state = true) {
    const stateOrAction = await getStateOrAction(type, id);

    return axios.put(
        'hue/' + type + '/' + id + state ? stateOrAction : '/' + type + '/' + id,
        request,
    );
}

/**
 * Remove a specific type Hue Item
 *
 * @param { string } type
 * @param { number } id
 *
 * @return { Promise<boolean> }
 */
async function removeHue(type, id) {
    return axios.delete('hue/' + type + '/' + id);
}

export default {
    postHue,
    putHue,
    removeHue,
};
