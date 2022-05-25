<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Regresar"
        to="/tiendas"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Alta de Tienda</h5>

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
      <header class="text-h6 col-8">Alta de Tienda</header>

      <q-form @submit="setTienda()" class="q-gutter-md col-12">
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
import { nanoid } from "nanoid";
export default {
  name: "Formulario-component",
  setup() {
    const nombre = ref(null);
    return {
      step: ref(1),
      nombre,
      clave: ref(null),
      direccion: ref(null),
      nombre_comercial: ref(null),
      gerente_nombre: ref(null),
    };
  },
  methods: {
    async setTienda() {
      const fecha = new Date().toISOString();

      const nuevoTienda = {
        nombre: this.nombre,
        tienda_id: nanoid(12),
        clave: this.clave,
        direccion: this.direccion,
        gerente_nombre: this.gerente_nombre,
        nombre_comercial: this.nombre_comercial,
        registro_autor_id: 1,
        registro_fecha: fecha,
      };

      try {
        await api.post("http://localhost:8080/api/tiendas/nuevo", nuevoTienda, {
          params: {
            api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
          },
        });
        console.log("Guardando nueva tienda...");
        this.$router.push("/tiendas");

        router.go(-1);
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  unmounted() {
    this.$emit("reload", true);
  },
};
</script>

<style>
</style>