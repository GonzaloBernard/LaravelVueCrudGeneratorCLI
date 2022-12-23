import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const View = { template: "<router-view></router-view>" };

const routes = [
    {
        path: "/",
        component: () => import("@pages/Layout/DashboardLayout.vue"),
        redirect: "dashboard",
        children: [
            {
                path: "dashboard",
                name: "dashboard",
                component: () => import("@pages/Dashboard.vue"),
                meta: { title: "Panel Informativo" },
            }, 
            // NEW VUE ROUTE
        ],
        
    },
];

export default new VueRouter({
    base: "/admin",
    routes,
});
