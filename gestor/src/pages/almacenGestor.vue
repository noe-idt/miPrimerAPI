<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de almacen"
        to="/almacenes/nuevo"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Almacenes</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Almacenes" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <tablaAlmacenes
    :columns="columns"
    :rows="rows"
    @reload="getStatus"
    :verDetalle="verDetalle"
  />
</template>

<script>
import { ref } from "vue";
import tablaAlmacenes from "../components/almacenes/tablaAlmacenes.vue";
import { api } from "boot/axios";
import FormularioAlmacen from "../components/almacenes/FormularioAlmacen.vue";
import verDetalle from "../components/almacenes/VistaDetalle.vue";

export default {
  name: "almacenesView",
  setup() {
    return {};
  },
  data() {
    return {
      rows: [],
      columns: [
        {
          name: "almacen_id",
          required: true,
          label: "Id.",
          align: "left",
          field: (row) => row.almacen_id,
          format: (val) => `${val}`,
          sortable: true,
          style: "width: 10px",
          headerStyle: "max-width: 50px",
        },
        {
          name: "clave",
          label: "CLAVE",
          field: (row) => row.clave,
        },
        {
          name: "nombre",
          label: "NOMBRE",
          field: (row) => row.nombre,
        },
        {
          name: "nombre_comercial",
          label: "NOMBRE COMERCIAL",
          field: (row) => row.nombre_comercial,
        },
        {
          name: "gerente_nombre",
          label: "GERENTE",
          field: (row) => row.gerente_nombre,
        },
        {
          name: "direccion",
          label: "DIRECCION",
          field: (row) => row.gerente_nombre,
        },
        {
          name: "registro",
          align: "center",
          label: "REGISTRO",
          field: (row) => row.registro_fecha + " | " + row.autor,
          sortable: true,
        },

        {
          name: "status",
          label: "STATUS",
          field: "status",
          sortable: true,
          style: "width: 150px",
        },
        {
          name: "actualizacion",
          label: "ACTUALIZACION",
          field: (row) => row.actualizacion_fecha + " | " + row.autor_act,

          style: "width: 200px",
        },
      ],

      verDetalle: verDetalle,
    };
  },
  components: {
    tablaAlmacenes,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get(
          "http://localhost:8080/api/almacenes/index",
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("api conectada");
        this.rows = respuesta.data;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    getStatus(instruction) {
      if (instruction) {
        console.log("reloading");
        this.obtenerDatos();
      }
    },
  },
  created() {
    this.obtenerDatos();
    this.getStatus();
  },
};
</script>

<style>
</style>