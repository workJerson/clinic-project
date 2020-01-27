import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
Vue.use(VueRouter);

// configure router
const router = new VueRouter({
    routes, // short for routes: routes
    linkActiveClass: "active"
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        const user = localStorage.getItem('loginInfo');
        if (user === null) {
            next({
                path: '/auth',
            });
        } else {
            next();
        }
    } else {
        next();
    }
})

export default router;
