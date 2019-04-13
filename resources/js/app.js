import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('passport', require('./components/PassPort.vue').default);
Vue.component('home', require('./components/Home.vue').default);

const app = new Vue({
    el: '#app'
});
