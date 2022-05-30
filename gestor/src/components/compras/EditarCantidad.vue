<template>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6">
      Editar Compra
      <q-btn
        :ripple="false"
        icon="close"
        class="float-right"
        flat
        v-close-popup
      ></q-btn>
    </header>

    <q-form @submit="updateProducto()" class="q-gutter-sm">
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
            v-model="cantidad"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            class=""
          >
            <template v-slot:before>
              <small>Cantidad</small>
              <small class="text-red q-pl-sm"> *</small></template
            >
          </q-input>
        </q-step>

        <q-step :name="2" :done="step > 2" title="">
          <q-input
            outlined
            v-model="precio"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
          >
            <template v-slot:before>
              <small>Precio Unitario</small>
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
              :class="step === 2 ? 'hidden' : ''"
            />
            <q-btn
              type="submit"
              color="primary"
              label="Enviar"
              class="float-right q-ml-xs"
              :class="step === 2 ? '' : 'hidden'"
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

export default {
  name: "Formulario-component",
  setup() {
    return {
      step: ref(1),
      cantidad: ref(null),
      precio: ref(null),
      producto_id: ref(null),
    };
  },
  methods: {
    obtenerDatos() {
      this.cantidad = this.producto.cantidad;
      this.precio = this.producto.precio;
      this.producto_id = this.producto.producto_id;
    },
    updateProducto() {
      const nuevosDatos = {
        producto_id: this.producto_id,
        cantidad: this.cantidad,
        precio: this.precio,
      };
      this.$emit("DatosNuevos", nuevosDatos);
    },
  },
  created() {
    this.obtenerDatos();
  },
  unmounted() {
    this.$emit("reload", true);
  },
  props: {
    producto: Object,
  },
};
</script>

<style>
</style>