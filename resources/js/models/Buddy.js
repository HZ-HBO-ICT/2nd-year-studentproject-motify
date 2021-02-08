/**
 * ## Buddy Model
 *
 * @author  Levi Deurloo <ldeurloo1@hz.nl>
 */
class Buddy {
    constructor(data) {
        this.id = data.id || Number;
        this.name = data.name || String;
        this.email = data.email || String;
        this.firstName = data.first_name || String;
        this.prefix = data.prefix || '';
        this.lastName = data.last_name || String;
        this.isAdmin = data.is_admin || Boolean(false);
        this.fullName = (this.firstName + (this.prefix === '') ? ' ':(' ' + this.prefix + ' ') + this.lastName);
        this.avatar = data.avatar;
    }
}

export default Buddy
