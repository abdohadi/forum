require('./bootstrap');

require('alpinejs');

const app = Vue.createApp({
  /* options */
});

import Flash from './components/Flash.vue';
import Reply from './components/Reply.vue';

app.component('flash', Flash);
app.component('reply', Reply);

app.mount('#app');

require('./helpers');