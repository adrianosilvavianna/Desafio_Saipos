require('./bootstrap');

window.Vue = require('vue');

Vue.component('candidate-component', require('./components/CandidateComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('app-component', require('./components/AppComponent.vue').default);

const app = new Vue({
    el: '#app',
});
