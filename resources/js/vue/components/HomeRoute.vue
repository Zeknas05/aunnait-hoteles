<template>
    <div class="flex">
        <!-- Panel izquierdo -->
        <div class="w-64 bg-gray-800 text-white h-screen p-4">
            <h2 class="text-xl mb-6">Menú</h2>
            <ul>
                <li>
                    <button @click="currentView = 'HotelHome'" class="w-full text-left px-4 py-2 mb-2">
                        Hoteles
                    </button>
                </li>
                <li>
                    <button @click="currentView = 'ServicesHome'" class="w-full text-left px-4 py-2 mb-2">
                        Servicios
                    </button>
                </li>
                <li>
                    <button @click="currentView = 'RoomHome'" class="w-full text-left px-4 py-2 mb-2">
                        Habitaciones
                    </button>
                </li>
                <li>
                    <button @click="currentView = 'GuestHome'" class="w-full text-left px-4 py-2 mb-2">
                        Huéspedes
                    </button>
                </li>
            </ul>
        </div>

        <!-- Parte derecha -->
        <div class="flex-1 p-6">
            <HotelHome v-if="currentView === 'HotelHome'" />
            <ServicesHome v-if="currentView === 'ServicesHome'" />
            <RoomHome v-if="currentView === 'RoomHome'" />
            <GuestHome v-if="currentView === 'GuestHome'" />
        </div>
    </div>
</template>

<script>
import HotelHome from "./HotelHome.vue";
import ServicesHome from "./ServicesHome.vue";
import RoomHome from "./RoomHome.vue";
import GuestHome from "./GuestHome.vue";

export default {
    components: {
        HotelHome,
        ServicesHome,
        RoomHome,
        GuestHome,
    },
    data() {
        return {
            currentView: "HotelHome", // Vista inicial
        };
    },
};
</script>
