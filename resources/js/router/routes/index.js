import { globalRoutes } from './global'
import { buddyRoutes } from './buddies'

let allRoutes = [globalRoutes, buddyRoutes];
let routes = [];

allRoutes.forEach((array) => array.forEach((route) => routes.push(route)));

export default routes;
