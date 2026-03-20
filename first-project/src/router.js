import { createRouter, createWebHashHistory } from "vue-router";

import Home from "./components/Home.vue";
import ContactUs from "./components/ContactUs.vue";
import Post from "./components/Post.vue";
import FormKit from "./components/FormKit.vue";
import ColorsPallet from "./components/ColorsPallet.vue";
import FIleUpload from "./components/FIleUpload.vue";

const routes = [
  { path: "/", redirect: "/home" },
  { path: "/home", component: Home },
  { path: "/contact", component: ContactUs },
  { path: "/post", component: Post },
  { path: "/formkit", component: FormKit },
  { path: "/colors", component: ColorsPallet },
  { path: "/upload", component: FIleUpload },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
});

export default router;
