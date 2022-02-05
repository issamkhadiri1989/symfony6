import './styles/app.css';
import './bootstrap';
import Routing from '../public/bundles/fosjsrouting/js/router.min.js';
const routes = require('../public/js/fos_js_routes.json');
Routing.setRoutingData(routes);
// Routing.generate('rep_log_list');
var route = Routing.generate('task_api');