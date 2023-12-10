import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import "./bootstrap";

import App from "./components/App.vue";
import Article from "./components/Article.vue";
import ArticleForm from "./components/ArticleForm.vue";
import ArticlesList from "./components/ArticlesList.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: ArticlesList },
        { path: "/articles/create", component: ArticleForm },
        { path: "/articles/:id", component: Article },
        { path: "/articles/:id/edit", component: ArticleForm },
    ],
});

const app = createApp(App);
app.use(router);
app.mount("#app");
