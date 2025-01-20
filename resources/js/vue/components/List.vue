  <template>
    <div>
      <h2>{{ title }}</h2>

      <!-- Tabla de datos -->
      <table class="table w-full">
        <thead>
          <tr>
            <th v-for="column in columns" :key="column.key">{{ column.label }}</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td v-for="column in columns" :key="column.key">
              <!-- Comprobamos si la columna es 'services' y mostramos solo el nombre de los servicios -->
              <span v-if="column.key === 'services'">
                <span v-for="(service, index) in item[column.key]" :key="index">
                  {{ service.name }}<span v-if="index < item[column.key].length - 1">, </span>
                </span>
              </span>
              <span v-else>
                {{ item[column.key] }}
              </span>
            </td>
            <td>
              <button @click="editItem(item)" class="btn btn-warning btn-sm mr-2">Editar</button>
              <button @click="deleteItem(item.id)" class="btn btn-error btn-sm">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Paginación y elementos por página -->
      <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
          <label for="itemsPerPage" class="mr-2">Elementos por página:</label>
          <select id="itemsPerPage" v-model="perPage" @change="fetchData" class="select select-bordered">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
        </div>

        <div class="flex items-center">
          <button @click="changePage(page - 1)" :disabled="page <= 1" class="btn btn-secondary btn-sm">Anterior</button>
          <span class="mx-2">{{ page }} / {{ lastPage }}</span>
          <button @click="changePage(page + 1)" :disabled="page >= lastPage"
            class="btn btn-secondary btn-sm">Siguiente</button>
        </div>
      </div>
      <div class="flex justify-start gap-4 mb-4">
        <!-- Panel de filtros -->
        <button @click="toggleFilters" class="btn btn-secondary">Filtros</button>
        <div>
          <button @click="createItem" class="btn btn-primary">Crear {{ itemLabel }}</button>
        </div>
      </div>
      <div v-if="filtersVisible">
        <div class="flex flex-wrap gap-4">
          <div v-for="column in columns" :key="column.key" class="flex flex-wrap gap-4">
            <div v-if="getComponentType(column.key) === 'select' || getComponentType(column.key) === 'select-multiple'">
              <label :for="'filter' + column.key" class="mr-2">Filtrar por {{ column.label }}:</label>
              <select :id="'filter' + column.key" v-model="filters[column.key]" @change="fetchData"
                :multiple="getComponentType(column.key) === 'select-multiple'" required
                class="input input-bordered w-full">
                <option v-for="option in getOptions(column.key)" :key="option.value" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>
            <div v-else-if="getComponentType(column.key) === 'date'">
              <label :for="'filter' + column.key" class="mr-2">{{ column.label }}:</label>
              <input type="date" :id="'filter' + column.key" v-model="filters[column.key]" @change="fetchData"
                class="input input-bordered w-full" autocomplete="filter"/>
            </div>
            <div v-else>
              <label :for="'filter' + column.key" class="mr-2">Filtrar por {{ column.label }}:</label>
              <input :id="'filter' + column.key" v-model="filters[column.key]" @input="fetchData" type="text"
                class="input input-bordered" :placeholder="column.label" autocomplete="'filter' + column.key"/>
            </div>
          </div>
        </div>



      </div>
      <!-- Modal DaisyUI -->
      <div v-if="isModalVisible" class="modal modal-open">
        <div class="modal-box">
          <h2 class="text-center text-2xl font-semibold mb-6">{{ isEditing ? 'Editar' : 'Crear' }} {{ itemLabel }}</h2>
          <form @submit.prevent="handleSubmit" class="space-y-4">
            <div v-for="column in columns" :key="column.key" class="space-y-2">
              <div
                v-if="getComponentType(column.key) === 'select' || getComponentType(column.key) === 'select-multiple'">
                <label :for="column.key" class="mr-2">{{ column.label }}:</label>
                <select :id="column.key" v-model="form[column.key]" :multiple="getComponentType(column.key) === 'select-multiple'"
                  required class="input input-bordered w-full">
                  <option v-for="option in getOptions(column.key)" :key="option.value" :value="option.value">
                    {{ option.text }}
                  </option>
                </select>
              </div>
              <div v-else>
                <label :for="column.key" class="mr-2">{{ column.label }}:</label>
                <input :id="column.key" v-model="form[column.key]" required class="input input-bordered w-full"  autocomplete="column.key"/>
              </div>
            </div>

            <!-- Botones Aceptar y Cancelar -->
            <div class="flex justify-end space-x-4 mt-4">
              <button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
              <button type="submit" class="btn btn-success">{{ isEditing ? 'Actualizar' : 'Crear' }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>

<script>
export default {
  props: {
    title: { type: String, required: true },
    itemLabel: { type: String, required: true },
    columns: { type: Array, required: true },
    apiUrl: { type: String, required: true },
    selectFields: { type: Object, required: false }
  },
  data() {
    return {
      items: [],
      page: 1,
      lastPage: null,
      perPage: 5,
      filtersVisible: false,
      filters: {},
      isModalVisible: false,
      isEditing: false,
      form: {},
      articulo: "",
    };
  },
  methods: {
    async fetchData() {
      try {
        // Generar los parámetros de la consulta
        const params = {
          ...this.filters,
          per_page: this.perPage,
          page: this.page
        };
        // Convertir los parámetros a una cadena de consulta
        const queryParams = new URLSearchParams();

        for (const key in params) {
          if (Array.isArray(params[key])) {
            params[key].forEach(value => queryParams.append(`${key}[]`, value));
          } else {
            queryParams.append(key, params[key]);
          }
        }
        const queryString = queryParams.toString();
        // Hacer la petición GET a la API
        const response = await fetch(`${this.apiUrl}?${queryString}`);
        const data = await response.json();

        // Actualizar los datos 
        this.items = data.data;
        this.page = data.current_page;
        this.lastPage = data.last_page;
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
    // Abrir el modal para crear un nuevo elemento
    createItem() {
      this.isEditing = false;
      this.form = {
        services: [],
      };
      this.isModalVisible = true;
    },

    // Abrir el modal para editar un elemento
    editItem(item) {
      this.isEditing = true;
      this.form = { ...item };
      this.isModalVisible = true;
    },
    async deleteItem(id) {
      if (this.itemLabel == "Habitación") {
        this.articulo = "la";
      } else {
        this.articulo = "el";
      }
      try {
        // Confirmación antes de eliminar
        if (
          !confirm(
            `¿Estás seguro de que quieres eliminar ${this.articulo} ${this.itemLabel}?`
          )
        )
          return;

        // Petición DELETE a la API
        const response = await fetch(
          `${this.apiUrl}/${id}`,
          {
            method: "DELETE",
          }
        );
        this.fetchData();
        if (!response.ok) {
          throw new Error(`Error al eliminar ${this.articulo} ${this.itemLabel}`);
        }
        alert(`${this.itemLabel} se ha eliminado correctamente.`);
      } catch (error) {
        console.error(`Error al eliminar ${this.articulo} ${this.itemLabel}:`, error);
        alert(`Hubo un problema al eliminar ${this.articulo} ${this.itemLabel}.`);
      }
    },
    // Enviar el formulario para crear o editar
    async handleSubmit() {
      if (this.isEditing) {
        await this.editItemAPI(this.form);
      } else {
        await this.createItemAPI(this.form);
      }
      this.fetchData();
      this.closeModal();
    },

    // Crear el elemento (envío a la API)
    async createItemAPI(formData) {
      const response = await fetch(this.apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      if (!response.ok) throw new Error("Error al crear el hotel");
    },

    // Editar el elemento (envío a la API)
    async editItemAPI(formData) {
      const response = await fetch(`${this.apiUrl}/${formData.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      if (!response.ok) throw new Error("Error al editar el hotel");
    },
    async editItemAPI(formData) {
      const response = await fetch(`${this.apiUrl}/${formData.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      if (!response.ok) throw new Error("Error al editar el hotel");
    },

    // Cerrar el modal
    closeModal() {
      this.isModalVisible = false;
    },
    changePage(page) {
      if (page >= 1 && page <= this.lastPage) {
        this.page = page;
        this.fetchData();
      }
    },
    toggleFilters() {
      this.filtersVisible = !this.filtersVisible;
    },
    getComponentType(key) {
      const column = this.columns.find(col => col.key === key);
      return column.type;
    },
    getOptions(key) {
      return this.selectFields[key] || [];
    }
  },
  mounted() {
    // Inicializar filtros dinámicamente
    this.columns.forEach(column => {
      if (column.type === 'select-multiple') {
        this.filters[column.key] = [];
      }
      else {
        this.filters[column.key] = "";
      }
    });
    this.fetchData();
  }
};
</script>