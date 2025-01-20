<template>
  <List title="Gestión de Huéspedes" itemLabel="Huésped" :columns="columns" :selectFields="selectFields"
    apiUrl="http://hoteles.test/api/guest" />
</template>

<script>
import List from "./List.vue";

export default {
  components: { List },
  data() {
    return {
      columns: [
        { key: "name", label: "Nombre", type: 'text' },
        { key: "surname", label: "Apellido", type: 'text' },
        { key: "passportID", label: "DNI", type: 'text' },
        { key: "checkinDate", label: "Fecha de entrada", type: 'date' },
        { key: "checkoutDate", label: "Fecha de salida", type: 'date' },
        { key: "roomId", label: "ID de la habitación", type: 'select' }
      ],
      selectFields: {
        roomId: [],
      },
      rooms: [],
    };
  },
  async created() {
    try {
      // Realiza una solicitud a la API para obtener la lista de habitaciones
      const response = await fetch("http://hoteles.test/api/room/all");
      if (!response.ok) {
        throw new Error(`Error en la solicitud: ${response.statusText}`);
      }
      this.rooms = await response.json();
      // Mapea los datos obtenidos para crear las opciones del select
      this.selectFields.roomId = this.rooms.map(room => ({
        value: room.id,
        text: `ID: ${room.id} - Número: ${room.number}`
      }));

    } catch (error) {
      console.error("Error al obtener las habitaciones:", error);
      // Manejo de errores adicional si es necesario
    }
  },
};
</script>