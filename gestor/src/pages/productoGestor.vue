<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de producto"
        @click="mostrarFormulario = true"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Productos</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Productos" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-dialog v-model="mostrarFormulario"
    ><FormularioProducto @reload="getStatus" />
  </q-dialog>
  <tablaComponente
    :columns="columns"
    :rows="rows"
    @reload="getStatus"
    :FormularioEditar="FormularioEditar"
    :FormularioEliminar="FormularioEliminar"
    :verDetalle="verDetalle"
  />
</template>

<script>
import { ref, computed } from "vue";
import tablaComponente from "../components/productos/tablaProductos.vue";
import { api } from "boot/axios";
import FormularioProducto from "../components/productos/FormularioProducto.vue";

import FormularioEditar from "../components/productos/FormularioEditarProducto.vue";
import FormularioEliminar from "../components/productos/FormularioEliminarProducto.vue";
import verDetalle from "../components/productos/verDetalleProducto.vue";
export default {
  name: "productosView",
  setup() {
    return {};
  },
  data() {
    return {
      rows: [],
      columns: [
        {
          name: "producto",
          label: "PRODUCTO",
          field: (row) => row.nombre,
        },
        {
          name: "descripcion",
          label: "DESCRIPCIÓN",
          field: (row) => row.descripcion,
          sortable: true,
        },

        {
          name: "precio",
          label: "PRECIO",
          field: (row) => row.precio,
        },
        {
          name: "fecha_registro",
          label: "FECHA DE REGISTRO",
          field: (row) => row.fecha_registro,
          style: "width: 200px",
        },
        {
          name: "status",
          label: "STATUS",
          field: (row) => row.status,
          sortable: true,

          style: "width: 150px",
        },
        {
          name: "opciones",
          field: "",
          style: "width: 10px",
          headerStyle: "max-width: 50px",
        },
      ],
      mostrarFormulario: ref(false),
      FormularioEditar: FormularioEditar,
      FormularioEliminar: FormularioEliminar,
      verDetalle: verDetalle,
    };
  },
  components: {
    tablaComponente,
    FormularioProducto,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get(
          "http://localhost:8080/api/productos/index",
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
    this.$emit("texto", "Alta de productos");
    this.obtenerDatos();
    this.getStatus();
  },
};
</script>

<style>
</style>

