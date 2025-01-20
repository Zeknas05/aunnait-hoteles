<template>
  <List title="Gestión de Servicios" itemLabel="Servicio" :columns="columns" apiUrl="http://hoteles.test/api/service" />
</template>

<script>
import List from "./List.vue";

export default {
  components: { List },
  data() {
    return {
      columns: [
        { key: "name", label: "Nombre", type: 'text' },
        { key: "description", label: "Descripción", type: 'text' },
      ]
    };
  },
};
</script>