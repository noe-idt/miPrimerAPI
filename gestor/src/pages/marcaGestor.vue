<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de marca"
        @click="mostrarFormulario = true"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Marcas</h5>
      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Marcas" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-dialog v-model="mostrarFormulario"
    ><FormularioMarca @reload="getStatus" />
  </q-dialog>
  <tablaMarcas
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
import tablaMarcas from "../components/marcaGestor/tablaMarcas.vue";
import { api } from "boot/axios";
import FormularioMarca from "../components/marcaGestor/FormularioMarca.vue";

import FormularioEditar from "../components/marcaGestor/FormularioEditarMarca.vue";
import FormularioEliminar from "../components/marcaGestor/FormularioEliminarMarca.vue";
import verDetalle from "../components/marcaGestor/verDetalleMarca.vue";
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
          name: "marca_id",
          required: true,
          label: "Id.",
          align: "left",
          field: (row) => row.marca_id,
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
          name: "registro_fecha",
          align: "center",
          label: "FECHA DE REGISTRO",
          field: "registro_fecha",
          sortable: true,
        },
        {
          name: "registro_autor_id",
          label: "AUTOR",
          field: "registro_autor_id",
        },
        {
          name: "actualizacion_fecha",
          label: "FECHA DE ACTUALIZACION",
          field: "actualizacion_fecha",
          style: "width: 200px",
        },

        {
          name: "actualizacion_autor_id",
          label: "AUTOR ACTUALIZACION",
          field: "actualizacion_autor_id",
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
    tablaMarcas,
    FormularioMarca,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get(
          "http://localhost:8080/api/marcas/index",
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

