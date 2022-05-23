<template>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6 text-center">
      {{ usuario }}
    </header>
    <q-card class="my-card" flat bordered>
      <q-item>
        <q-item-section avatar>
          <q-avatar> </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label>{{ usuario }}</q-item-label>
          <q-item-label caption> {{ nombre }} </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-card-section horizontal>
        <q-card-section> Dirección de correo: {{ correo }} </q-card-section>

        <q-separator vertical />

        <q-card-section class="col-4">
          Fecha de registro: {{ fecha_reg }} <br />
          Status: {{ status }}
        </q-card-section>
      </q-card-section>
      <q-btn
        no-caps
        color="primary"
        label="Salir"
        class="q-ml-sm float-right"
        v-close-popup
      />
    </q-card>
  </q-card>
</template>

<script>
import { ref } from "vue";
import { api } from "boot/axios";

export default {
  name: "Formulario-component",
  setup() {
    const nombre = ref(null);
    const usuario = ref(null);
    const correo = ref(null);
    const password = ref(null);
    const fecha_reg = ref(null);
    const status = ref(null);
    return {
      step: ref(1),
      nombre,
      usuario,
      correo,
      password,
      fecha_reg,
      status,
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
        this.correo = datosUsuario.correo;
        this.password = datosUsuario.password;
        this.fecha_reg = datosUsuario.fecha_registro;
        this.status = datosUsuario.status;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  created() {
    this.obtenerDatos();
  },
  props: {
    id: Number,
  },
};
</script>

<style>
</style>