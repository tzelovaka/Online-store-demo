import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { 
    faUserSecret, 
    faCartShopping, 
    faMagnifyingGlass, 
    faUser, 
    faBars, 
    faChevronDown, 
    faChevronLeft, 
    faRankingStar, 
    faListCheck, 
    faDna, 
    faTrash, 
    faArrowUpRightFromSquare,
    faCircleChevronRight,
    faCircleChevronLeft,
    faXmark,
    faMagnifyingGlassArrowRight,
    faEllipsis
} from '@fortawesome/free-solid-svg-icons'
import { faTelegram, faViber, faInstagram, faVk } from '@fortawesome/free-brands-svg-icons';
library.add(faUserSecret, faCartShopping, faTelegram, faViber, faInstagram, faVk, faMagnifyingGlass, faUser, faBars, faChevronDown, faChevronLeft, faRankingStar, faListCheck, faDna, faTrash, faArrowUpRightFromSquare, faCircleChevronRight, faCircleChevronLeft, faXmark, faMagnifyingGlassArrowRight, faEllipsis)
const appName = import.meta.env.VITE_APP_NAME || 'Metaliet';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
