export default {
    state: {
        api_token: null,
        user_id: 0,
        name: null
    },
    /**
     * Sets up user's data from local storage
     * @returns {void}
     */
    init() {
        this.state.api_token = localStorage.getItem('api_token');
        this.state.user_id = parseInt(localStorage.getItem('user_id'));
        this.state.name = localStorage.getItem('name');
    },
    /**
     * Sets user's data to local storage
     * @param {string} api_token
     * @param {integer} user_id
     * @param {string} name
     * @returns {void}
     */
    set(api_token, user_id, name) {
        localStorage.setItem('api_token', api_token);
        localStorage.setItem('user_id', user_id);
        localStorage.setItem('name', name);

        this.init();
    },
    /**
     * Removes user's data from local storage
     * @returns {void}
     */
    remove() {
        localStorage.removeItem('api_token');
        localStorage.removeItem('user_id');
        localStorage.removeItem('name');

        this.init();
    },
    /**
     * Returns if user is authenticated
     * @returns {Boolean}
     */
    authenticated() {
        if (this.state.api_token && this.state.user_id) {
            return true;
        }

        return false;
    }
}