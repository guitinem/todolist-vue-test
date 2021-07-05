require('./bootstrap');

import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrash, faPlusSquare } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTrash, faPlusSquare)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false


import App from './vue/app.vue'

const app = new Vue({
    el: '#app',
    components: { App }
})
