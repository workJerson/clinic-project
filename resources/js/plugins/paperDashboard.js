import Notify from "vue-notifyjs";
import SideBar from "../components/SidebarPlugin";
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import "es6-promise/auto";

//css assets
import "../assets/sass/paper-dashboard.scss";
import "bootstrap/dist/css/bootstrap.css";
import "../assets/css/themify-icons.css";

export default {
    install(Vue) {
        Vue.use(GlobalComponents);
        Vue.use(GlobalDirectives);
        Vue.use(SideBar);
        Vue.use(Notify);
    }
}
