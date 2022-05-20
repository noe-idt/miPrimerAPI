<template>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6">
      Agregar Usuario
      <q-btn
        :ripple="false"
        icon="close"
        class="float-right"
        flat
        v-close-popup
      ></q-btn>
    </header>

    <q-form @submit="setUsuario()" class="q-gutter-sm">
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
            v-model="usuario"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            class=""
          >
            <template v-slot:before>
              <small>Usuario</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>

        <q-step :name="2" :done="step > 2" title="">
          <q-input
            outlined
            v-model="correo"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
          >
            <template v-slot:before>
              <small>Correo</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>

        <q-step :name="3" done-icon="none" title="">
          <q-input
            outlined
            v-model="nombre"
            label-slot
            lazy-rules
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Nombre</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>
        <q-step :name="4" done-icon="none" title="">
          <q-input
            outlined
            v-model="password"
            label-slot
            lazy-rules
            dense="dense"
            required
            type="password"
          >
            <template v-slot:before>
              <small>Contraseña</small>
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
              :class="step === 4 ? 'hidden' : ''"
            />
            <q-btn
              type="submit"
              color="primary"
              label="Enviar"
              class="float-right q-ml-xs"
              :class="step === 4 ? '' : 'hidden'"
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
    const nombre = ref(null);
    const usuario = ref(null);
    const correo = ref(null);
    const password = ref(null);

    return {
      step: ref(1),
      nombre,
      usuario,
      correo,
      password,
    };
  },
  methods: {
    async setUsuario() {
      const nuevoUsuario = {
        usuario: this.usuario,
        nombre_usuario: this.nombre,
        correo: this.correo,
        password: this.password,
      };

      console.log(nuevoUsuario);

      try {
        await api.post(
          "http://localhost:8080/api/usuarios/nuevo",
          nuevoUsuario,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("Guardando usuario nuevo...");
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  unmounted() {
    this.$emit("reload", "true");
  },
};
</script>

<style>
</style>