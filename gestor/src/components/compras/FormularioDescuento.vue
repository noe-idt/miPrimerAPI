<template>
  <q-card class="q-pa-lg" style="width: 550px; max-width: 80vw">
    <header class="text-h6">
      Aplicar Descuento
      <q-btn
        :ripple="false"
        icon="close"
        class="float-right"
        flat
        v-close-popup
      ></q-btn>
    </header>
    <q-form @submit="setDescuento()" class="q-gutter-sm">
      <q-input
        outlined
        v-model="descuento"
        label-slot
        lazy-rules
        :rules="[(val) => (val && val.length > 0) || 'Please type something']"
        dense="dense"
        required
        type="number"
      >
        <template v-slot:before>
          <small>Descuento</small>
          <small class="text-red q-pl-sm"> *</small></template
        >
      </q-input>
      <q-btn
        type="submit"
        color="primary"
        label="Enviar"
        class="float-right q-ml-xs"
        v-close-popup
      />
    </q-form>
  </q-card>
</template>

<script>
import { ref } from "vue";
export default {
  name: "Descuento-component",
  setup() {
    return {
      descuento: ref(null),
    };
  },
  methods: {
    setDescuento() {
      this.$emit("descuento", this.descuento);
    },
  },
};
</script>

<style>
</style>