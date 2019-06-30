window.Vue = require('vue');
import axios from 'axios'; 
import Swal from 'sweetalert2';
import JsonExcel from 'vue-json-excel';

Vue.component('downloadExcel', JsonExcel);
Vue.component('pagination', require('laravel-vue-pagination'));

window.Swal = Swal;
const token = document.head.querySelector('meta[name="token"]');
axios.defaults.headers.common['TOKEN'] = token.content;
window.axios = axios;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
window.toast = toast;  
window.obj = {};
window.editmode = false;
Vue.component('parents-index', require('./components/parents/Index.vue').default);
import _ from 'lodash'; 
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};
window.$ = window.jQuery = require('jquery');

require('moment');
import flatpickr from "flatpickr";

// require('pc-bootstrap4-datetimepicker');
// const app = new Vue({
//     el: '#app',
   
//  });
