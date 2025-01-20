import { createRouter, createWebHistory } from "vue-router";
import HomeRoute from "./vue/components/HomeRoute.vue";
import HotelHome from "./vue/components/HotelHome.vue";
import GuestHome from "./vue/components/GuestHome.vue";
import ServicesHome from "./vue/components/ServicesHome.vue";
import RoomHome from "./vue/components/RoomHome.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: HomeRoute,
    },
    {
        path: "/hotel",
        name: "hotel",
        component: HotelHome,
    },
    {
        path: "/guests",
        name: "guests",
        component: GuestHome,
    },
    {
        path: "/services",
        name: "services",
        component: ServicesHome,
    },
    {
        path: "/rooms",
        name: "rooms",
        component: RoomHome,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
