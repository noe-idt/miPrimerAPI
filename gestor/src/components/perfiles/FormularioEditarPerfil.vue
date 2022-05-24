<template>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6">
      Editar Perfil
      <q-btn
        :ripple="false"
        icon="close"
        class="float-right"
        flat
        v-close-popup
      ></q-btn>
    </header>

    <q-form @submit="updatePerfil()" class="q-gutter-sm">
      <q-stepper
        header-class="hidden"
        v-model="step"
        ref="stepper"
        animated
        flat
      >
        <q-step :name="1" :done="step > 1" title="">
          <q-input
            outlined
            v-model="clave"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Clave</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>

        <q-step :name="2" :done="step > 1" title="">
          <q-input
            outlined
            v-model="nombre"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Nombre</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>
        <q-step :name="3" :done="step > 1" title="">
          <q-input
            outlined
            v-model="descripcion"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Descripción</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>
        <template v-slot:navigation>
          <q-stepper-navigation>
            <q-btn
              @click="$refs.stepper.next()"
              color="primary"
              label="siguiente"
              class="float-right q-ml-xs"
              :class="step === 3 ? 'hidden' : ''"
            />
            <q-btn
              type="submit"
              color="primary"
              label="Enviar"
              class="float-right q-ml-xs"
              :class="step === 3 ? '' : 'hidden'"
              @click="$refs.stepper.next()"
              v-close-popup
            />
            <q-btn
              v-if="step > 1"
              flat
              color="primary"
              @click="$refs.stepper.previous()"
              label="Back"
              class="q-ml-sm float-right"
            />
          </q-stepper-navigation>
        </template>
      </q-stepper>
    </q-form>
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
      descripcion: ref(null),
      clave: ref(null),
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const perfil = this.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/perfiles/${perfil}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Perfil obtenido");
        const datosPerfil = respuesta.data[0];
        this.nombre = datosPerfil.nombre;
        this.clave = datosPerfil.clave;
        this.descripcion = datosPerfil.descripcion;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    async updatePerfil() {
      const perfil = this.id;
      const nuevosDatos = {
        nombre: this.nombre,
        descripcion: this.descripcion,
        clave: this.clave,
        actualizacion_autor_id: 1,
      };

      try {
        await api.post(
          `http://localhost:8080/api/perfiles/editar/${perfil}`,
          nuevosDatos,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("Perfil editado exitosamente");
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