import { createRouter, createWebHashHistory } from "vue-router";
import Login from "./pages/Login.vue";
import Main from "./pages/Main.vue";

const routes = createRouter({
  history: createWebHashHistory(),
  routes: [
    { path: "/", component: Main, name: "main" },
    { path: "/login", component: Login, name: "login" },
  ],
});

export default routes;
