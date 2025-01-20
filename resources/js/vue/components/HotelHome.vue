<template>
    <List title="Gestión de Hoteles" itemLabel="Hotel" :columns="columns" :selectFields="selectFields"
        apiUrl="http://hoteles.test/api/hotel" />

</template>

<script>
import List from "./List.vue";

export default {
    components: { List },
    data() {
        return {
            columns: [
                { key: "name", label: "Nombre", type: 'text' },
                { key: "adress", label: "Dirección", type: 'text' },
                { key: "phoneNumber", label: "Teléfono", type: 'text' },
                { key: "email", label: "Email", type: 'text' },
                { key: "website", label: "Web", type: 'text' },
                { key: "services", label: "Servicios", type: 'select-multiple' },
            ],
            selectFields: {
                services: [],
            },
            services: [],
        };
    },
    async created() {
        try {
            // Realiza una solicitud a la API para obtener la lista de servicios
            const response = await fetch("http://hoteles.test/api/service/all");
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            this.services = await response.json();
            // Mapea los datos obtenidos para crear las opciones del select
            this.selectFields.services = this.services.map(service => ({
                value: service.id,
                text: `ID: ${service.id} - Nombre: ${service.name}`
            }));

        } catch (error) {
            console.error("Error al obtener los servicios:", error);
            // Manejo de errores adicional si es necesario
        }
    },
};
</script>
