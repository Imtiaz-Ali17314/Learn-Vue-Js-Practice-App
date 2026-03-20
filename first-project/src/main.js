import { createApp } from "vue";
import App from "./App.vue";
import router from "./router.js";

//     Bootstrap
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

//      Font Awesome
import "@fortawesome/fontawesome-free/css/all.min.css";

//      Animations
import "animate.css";

//      FormKit
import { plugin, defaultConfig } from "@formkit/vue";
import "@formkit/themes/genesis";

createApp(App).use(router).use(plugin, defaultConfig).mount("#app");
