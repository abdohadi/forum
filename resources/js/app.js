require('./bootstrap');

require('alpinejs');

const app = Vue.createApp({
  /* options */
});

import Flash from './components/Flash.vue';

app.component('flash', Flash);

app.mount('#app')

require('./helpers');