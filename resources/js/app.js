require('./bootstrap');

window.Vue = require('vue');

Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('task-component', require('./components/TaskComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('app-component', require('./components/AppComponent.vue').default);

const app = new Vue({
    el: '#app',
});
