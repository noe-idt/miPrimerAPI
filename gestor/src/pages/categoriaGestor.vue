<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de categoria"
        @click="mostrarFormulario = true"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Categorias</h5>
      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Categorias" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-dialog v-model="mostrarFormulario" persistent
    ><FormularioCategoria @reload="getStatus" />
  </q-dialog>
  <tablaCategorias
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
import tablaCategorias from "../components/categorias/tablaCategorias.vue";
import { api } from "boot/axios";
import FormularioCategoria from "../components/categorias/FormularioCategoria.vue";

import FormularioEditar from "../components/categorias/FormularioEditarCategoria.vue";
import FormularioEliminar from "../components/categorias/FormularioEliminarCategoria.vue";
import verDetalle from "../components/categorias/verDetalleCategoria.vue";
export default {
  name: "usuariosView",
  setup() {
    return {};
  },
  data() {
    return {
      rows: [],
      columns: [
        {
          name: "categoria_id",
          required: true,
          label: "Id.",
          align: "left",
          field: (row) => row.categoria_id,
          format: (val) => `${val}`,
          sortable: true,
          style: "width: 10px",
          headerStyle: "max-width: 50px",
        },
        {
          name: "nombre",
          label: "NOMBRE",
          field: (row) => row.nombre,
        },
        {
          name: "registro",
          align: "center",
          label: "REGISTRO",
          field: (row) => row.registro_fecha + " | " + row.autor,
          sortable: true,
        },
        {
          name: "actualizacion",
          label: "ACTUALIZACION",
          field: (row) => row.actualizacion_fecha + " | " + row.autor_act,

          style: "width: 200px",
        },

        {
          name: "status",
          label: "STATUS",
          field: "status",
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
    tablaCategorias,
    FormularioCategoria,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get(
          "http://localhost:8080/api/categorias/index",
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
    this.$emit("texto", "Alta de usuarios");
    this.obtenerDatos();
    this.getStatus();
  },
};
</script>

<style>
</style>

