import DashboardLayout from "../layout/dashboard/DashboardLayout.vue";
import Auth from "../layout/auth/Auth.vue";
import Login from "../pages/Auth/Login.vue";
// GeneralViews
import NotFound from "../pages/NotFoundPage.vue";

// Admin pages
import Dashboard from "../pages/Dashboard.vue";
import UserProfile from "../pages/UserProfile.vue";
import Notifications from "../pages/Notifications.vue";
import Icons from "../pages/Icons.vue";
import Maps from "../pages/Maps.vue";
import Typography from "../pages/Typography.vue";
import TableList from "../pages/TableList.vue";

// user module
import UserTableList from "../pages/UserTableList.vue";

// hmo module
import HMOTableList from "../pages/HMOTableList.vue";
import CreateHMO from "../pages/CreateHMO.vue";
import UpdateHMO from "../pages/UpdateHMO.vue";

//services module
import ServiceTableList from "../pages/ServiceTableList.vue";

const routes = [
    {
        path: '/auth',
        component: Auth,
        children: [
            { path: '', name: 'userLogin', component: Login },
        ]
    },
    {
        path: "/",
        component: DashboardLayout,
        meta: {
            requiresAuth: true,
        },
        redirect: "/dashboard",
        children: [
            {
                path: "dashboard",
                name: "dashboard",
                component: Dashboard
            },
            {
                path: "stats",
                name: "stats",
                component: UserProfile
            },
            {
                path: "notifications",
                name: "notifications",
                component: Notifications
            },
            {
                path: "icons",
                name: "icons",
                component: Icons
            },
            {
                path: "maps",
                name: "maps",
                component: Maps
            },
            {
                path: "typography",
                name: "typography",
                component: Typography
            },
            {
                path: "table-list",
                name: "table-list",
                component: TableList
            },
            {
                path: "user-table-list",
                name: "User Master List",
                component: UserTableList
            },
            {
                path: "hmo-table-list",
                name: "HMO Master List",
                component: HMOTableList
            },
            {
                path: "hmo-table-list/create",
                name: "Create New HMO",
                component: CreateHMO
            },
            {
                path: "hmo-table-list/update/:id",
                name: "Update HMO",
                component: UpdateHMO
            },
            {
                path: "service-table-list",
                name: "Services Master List",
                component: ServiceTableList
            },
        ]
    },
    { path: "*", component: NotFound }
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
