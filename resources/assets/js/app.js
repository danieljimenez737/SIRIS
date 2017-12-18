
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */


Vue.component('principal',require('./components/main.vue'));
Vue.component('mapa',require('./components/mapa.vue'));
Vue.component('test',require('./components/test.vue'));
import * as VueGoogleMaps from 'vue2-google-maps';
import Vuetify from 'vuetify';
import Autocomplete from 'vue2-autocomplete-js';
import VueGoogleAutocomplete from 'vue-google-autocomplete'

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBfeCLUhsQEcT3qSGQH3aKM_AknKoy8N3Q',
    libraries: 'places', // This is required if you use the Autocomplete plugin
  }
})


 
Vue.use(Vuetify);
    
const app = new Vue({
    el: '#app',
     
});

