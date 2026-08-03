import './bootstrap';

import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import 'admin-lte/dist/css/adminlte.min.css';
import 'admin-lte/dist/js/adminlte.min.js';

window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();
