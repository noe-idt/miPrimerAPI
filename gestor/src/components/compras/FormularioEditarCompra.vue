<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Regresar"
        to="/almacenes"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Editar Almacen</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Perfiles" />
          <q-breadcrumbs-el label="Detalle" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <div class="">
    <q-card class="q-pa-lg q-ma-lg absolute-center row">
      <header class="text-h6 col-8">Alta de Almacen</header>

      <q-form @submit="updateAlmacen()" class="q-gutter-md col-12">
        <q-input
          outlined
          v-model.trim="nombre"
          max="100"
          label-slot
          lazy-rules
          :rules="[(val) => (val && val.length > 0) || 'Please type something']"
          dense="dense"
          required
        >
          <template v-slot:before>
            <small>Nombre</small>
            <small class="text-red q-pl-sm"> *</small></template
          >
        </q-input>

        <q-input
          outlined
          v-model.trim="nombre_comercial"
          label-slot
          lazy-rules
          maxlength="150"
          :rules="[(val) => (val && val.length > 0) || 'Please type something']"
          dense="dense"
          required
        >
          <template v-slot:before>
            <small>Nombre Comercial</small>
            <small class="text-red q-pl-sm"> *</small></template
          >
        </q-input>

        <q-input
          outlined
          v-model.trim="clave"
          label-slot
          lazy-rules
          maxlength="20"
          :rules="[(val) => (val && val.length > 0) || 'Please type something']"
          dense="dense"
          required
        >
          <template v-slot:before>
            <small>Clave</small>
            <small class="text-red q-pl-sm"> *</small></template
          >
        </q-input>

        <q-input
          outlined
          v-model.trim="gerente_nombre"
          label-slot
          maxlength="80"
          lazy-rules
          :rules="[(val) => (val && val.length > 0) || 'Please type something']"
          dense="dense"
          required
        >
          <template v-slot:before>
            <small>Gerente</small>
            <small class="text-red q-pl-sm"> *</small></template
          >
        </q-input>

        <q-input
          outlined
          v-model.trim="direccion"
          label-slot
          maxlength="300"
          lazy-rules
          :rules="[(val) => (val && val.length > 0) || 'Please type something']"
          dense="dense"
          required
        >
          <template v-slot:before>
            <small>Dirección</small>
            <small class="text-red q-pl-sm"> *</small></template
          >
        </q-input>

        <q-btn
          type="submit"
          color="primary"
          label="Enviar"
          class="float-right col-xs-1"
        />
      </q-form>
    </q-card>
  </div>
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
      clave: ref(null),
      direccion: ref(null),
      nombre_comercial: ref(null),
      gerente_nombre: ref(null),
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const tienda = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/almacenes/${tienda}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Almacen obtenido");
        const datosAlmacen = respuesta.data[0];
        this.nombre = datosAlmacen.nombre;
        this.clave = datosAlmacen.clave;
        this.direccion = datosAlmacen.direccion;
        this.gerente_nombre = datosAlmacen.gerente_nombre;
        this.nombre_comercial = datosAlmacen.nombre_comercial;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    async updateAlmacen() {
      const tienda = this.$route.params.id;
      const fecha = new Date().toISOString();

      const nuevosDatos = {
        nombre: this.nombre,
        clave: this.clave,
        direccion: this.direccion,
        gerente_nombre: this.gerente_nombre,
        nombre_comercial: this.nombre_comercial,
        actualizacion_fecha: fecha,
        actualizacion_autor_id: 1,
      };

      try {
        await api.post(
          `http://localhost:8080/api/almacenes/editar/${tienda}`,
          nuevosDatos,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("Almacen editado exitosamente");
        this.$router.push("/almacenes");
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  created() {
    this.obtenerDatos();
  },

  unmounted() {
    this.$emit("reload", true);
  },
  props: {
    id: Number,
  },
};
</script>

<style>
</style>