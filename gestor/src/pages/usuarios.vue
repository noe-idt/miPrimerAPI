<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de usuario"
        @click="mostrarFormulario = true"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Usuarios</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Usuarios" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-dialog v-model="mostrarFormulario"
    ><FormularioUsuario @reload="getStatus" />
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
import tablaComponente from "../components/tablaComponente.vue";
import { api } from "boot/axios";
import FormularioUsuario from "../components/FormularioUsuario.vue";

import FormularioEditar from "../components/FormularioEditar.vue";
import FormularioEliminar from "../components/FormularioEliminar.vue";
import verDetalle from "../components/verDetalle.vue";
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
          name: "id_usuario",
          required: true,
          label: "No.",
          align: "left",
          field: (row) => row.id_usuario,
          format: (val) => `${val}`,
          sortable: true,
          style: "width: 10px",
          headerStyle: "max-width: 50px",
        },
        {
          name: "usuario",
          label: "USUARIO",
          field: (row) => row.usuario,
        },
        {
          name: "nombre_usuario",
          align: "center",
          label: "NOMBRE",
          field: (row) => row.nombre_usuario,
          sortable: true,
        },

        {
          name: "correo",
          label: "CORREO",
          field: (row) => row.correo,
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
    FormularioUsuario,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get("http://localhost:8080/api/usuarios", {
          params: {
            api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
          },
        });
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

