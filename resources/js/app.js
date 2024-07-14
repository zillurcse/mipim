require("./bootstrap");

// Import modules...
import Vue from "vue";
import VueQuillEditor from "vue-quill-editor";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import VueFileAgent from "vue-file-agent";
import VueFileAgentStyles from "vue-file-agent/dist/vue-file-agent.css";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";
import Toasted from "vue-toasted";
Vue.use(Toasted);
Vue.use(VueQuillEditor /* { default global options } */);
Vue.use(VueFileAgent);
Vue.mixin({
    methods: {
        route,
    },
});
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById("app");

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
