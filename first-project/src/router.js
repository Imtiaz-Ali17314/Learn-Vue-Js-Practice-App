import { createRouter, createWebHashHistory } from "vue-router";

import Home from "./components/Home.vue";
import ContactUs from "./components/ContactUs.vue";
import Post from "./components/Post.vue";
import FormKit from "./components/FormKit.vue";
import ColorsPallet from "./components/ColorsPallet.vue";
import FileUpload from "./components/FIleUpload.vue";

const routes = [
  { path: "/", redirect: "/home" },
  {
    path: "/home",
    component: Home,
    meta: { title: "Home | Vue Learning Hub" },
  },
  {
    path: "/contact",
    component: ContactUs,
    meta: { title: "Contact Us | Vue Learning Hub" },
  },
  {
    path: "/post",
    component: Post,
    meta: { title: "Posts Sandbox | Vue Learning Hub" },
  },
  {
    path: "/formkit",
    component: FormKit,
    meta: { title: "FormKit Sandbox | Vue Learning Hub" },
  },
  {
    path: "/colors",
    component: ColorsPallet,
    meta: { title: "Color Palette | Vue Learning Hub" },
  },
  {
    path: "/upload",
    component: FileUpload,
    meta: { title: "File Upload | Vue Learning Hub" },
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
});

export default router;

