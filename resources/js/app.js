/*!

 =========================================================
 * Vue Paper Dashboard - v2.0.0
 =========================================================

 * Product Page: http://www.creative-tim.com/product/paper-dashboard
 * Copyright 2019 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE.md)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */
import Vue from "vue";
import App from "./App.vue";
import router from "./router/index.js";
import PaperDashboard from "./plugins/paperDashboard";
import "vue-notifyjs/themes/default.css";
import axios from 'axios';

Vue.use(PaperDashboard);

Vue.prototype.$axios = axios
window.axios = axios
const loginInfo = localStorage.loginInfo ? JSON.parse(localStorage.loginInfo) : null
axios.defaults.headers.post['Content-Type'] = 'application/json;charset=utf-8;application/x-www-form-urlencoded'
axios.defaults.baseURL = 'http://localhost:8089'
axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*'
if (loginInfo) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${loginInfo.access_token}`
}

/* eslint-disable no-new */
new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
