<template>
  <q-card class="q-pa-lg" style="max-width: 80vw">
    <header class="text-h6" style="width: 100%">
      Eliminar Usuario
      <q-btn
        :ripple="false"
        icon="close"
        class="float-right"
        flat
        v-close-popup
      ></q-btn>
      <br />
      <q-badge
        class="bg-orange-1 text-orange-6 q-ma-lg q-pa-md"
        outline
        style="width: 90%"
      >
        <q-icon name="o_warning_amber" class="q-mr-md" size="30px"></q-icon>
        <span>Esta acción no se puede deshacer</span>
      </q-badge>
    </header>
    <body style="width: 100%">
      <div class="text-center q-pa-md">
        <br />
        <span class="text-body1 text-weight-light"
          >¿Estás seguro que deseas eliminar el siguiente registro?</span
        >
        <br />
        <strong class="text-weight-medium text-grey-9 q-my-xs">
          {{ usuario }} - {{ nombre }}</strong
        >
      </div>
      <q-btn
        color="primary"
        label="Sí, deseo eliminar"
        class="float-right q-ml-xs"
        @click="eliminarUsuario()"
        v-close-popup
      />
      <q-btn
        flat
        no-caps
        color="primary"
        label="No, salir de esta ventana"
        class="q-ml-sm float-right"
        v-close-popup
      />
    </body>
  </q-card>
</template>

<script>
import { ref } from "vue";
import { api } from "boot/axios";

export default {
  name: "Formulario-component",
  setup() {
    return {
      step: ref(1),
      nombre: ref(null),
      usuario: ref(null),
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const usuario = this.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/usuarios/${usuario}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Usuario Obtenido");
        const datosUsuario = respuesta.data[0];
        this.nombre = datosUsuario.nombre_usuario;
        this.usuario = datosUsuario.usuario;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    async eliminarUsuario() {
      const usuario = this.id;
      try {
        const respuesta = await api.get(
          `http://localhost:8080/api/usuarios/eliminar/${usuario}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Eliminando usuario...");
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  created() {
    this.obtenerDatos();
  },
  unmounted() {
    this.$emit("reload", "true");
  },
  props: {
    id: Number,
  },
};
</script>

<style>
</style>