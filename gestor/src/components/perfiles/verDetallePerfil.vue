<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de usuario"
        @click="mostrarFormulario = true"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Detalle de perfil</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Perfiles" />
          <q-breadcrumbs-el label="Detalle" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6 text-center">
      {{ nombre }}
    </header>
    <q-card class="my-card" flat bordered>
      <q-item>
        <q-item-section avatar>
          <q-avatar> </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label>{{ nombre }}</q-item-label>
          <q-item-label caption> {{ nombre }} </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-card-section horizontal>
        <q-card-section> Registrada por : {{ autor }} </q-card-section>

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

    const password = ref(null);
    const fecha_reg = ref(null);
    const status = ref(null);
    return {
      step: ref(1),
      nombre,

      password,
      fecha_reg,
      status,
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const perfil = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/perfiles/${perfil}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Perfil Obtenido");
        const datosPerfil = respuesta.data[0];
        this.nombre = datosPerfil.nombre;
        this.clave = datosPerfil.clave;
        this.descripcion = datosPerfil.descripcion;
        this.fecha_reg = datosPerfil.registro_fecha;
        this.autor = datosPerfil.autor;
        this.fecha_actu = datosPerfil.actualizacion_fecha;
        this.autor_act = datosPerfil.autor_act;
        this.status = datosPerfil.status;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  created() {
    this.obtenerDatos();
  },
  props: {
    id: String,
  },
};
</script>

<style>
</style>