<template>
  <List title="Gestión de Habitaciones" itemLabel="Habitación" :columns="columns" :selectFields="selectFields"
    apiUrl="http://hoteles.test/api/room" />
</template>

<script>
import List from "./List.vue";

export default {
  components: { List },
  data() {
    return {
      columns: [
        { key: "number", label: "Número", type: 'text' },
        { key: "type", label: "Tipo", type: 'text' },
        { key: "nightPrice", label: "Precio por noche", type: 'text' },
        { key: "hotelId", label: "ID del hotel", type: 'select' },
      ],
      selectFields: {
        hotelId: [],
      },
      hotels: [],
    };
  },
  async created() {
    try {
      // Realiza una solicitud a la API para obtener la lista de hoteles
      const response = await fetch("http://hoteles.test/api/hotel/all");
      if (!response.ok) {
        throw new Error(`Error en la solicitud: ${response.statusText}`);
      }
      this.hotels = await response.json();
      // Mapea los datos obtenidos para crear las opciones del select
      this.selectFields.hotelId = this.hotels.map(hotel => ({
        value: hotel.id,
        text: `ID: ${hotel.id} - Nombre: ${hotel.name}`
      }));

    } catch (error) {
      console.error("Error al obtener los hoteles:", error);
      // Manejo de errores adicional si es necesario
    }
  },
};
</script>