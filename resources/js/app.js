import Dashboard from './components/Dashboard.vue';
import welcomeFooter from './components/welcome_components/welcomeFooter.vue';

import { createApp } from 'vue'
import router from './router' // <---

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas, far, fab)

const app = ({
    el: '#app',
    router: router,
    components: {
        "component-dashboard": Dashboard,
        "welcome-footer": welcomeFooter,
    }
});
createApp(app).use(router).component('font-awesome-icon', FontAwesomeIcon).mount('#app')