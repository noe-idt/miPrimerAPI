<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        @click="$refs.stepper.next()"
        color="primary"
        label="siguiente"
        class="float-right q-ml-xs"
        :class="step === 3 ? 'hidden' : ''"
      />
      <q-btn
        v-if="step > 1"
        flat
        color="primary"
        @click="$refs.stepper.previous()"
        label="Regresar"
        class="q-ml-sm float-right"
      /><q-btn
        class="float-right"
        color="primary"
        label="Anterior"
        to="/compras"
      ></q-btn>
      <q-btn
        type="submit"
        color="primary"
        label="Enviar"
        class="float-right q-ml-xs"
        :class="step === 3 ? '' : 'hidden'"
        @click="$refs.stepper.next()"
        v-close-popup
      />

      <h5 class="q-my-none q-mx-lg">Alta de Compra</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Perfiles" />
          <q-breadcrumbs-el label="Detalle" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-stepper v-model="step" ref="stepper" animated class="q-my-none">
    <q-step :name="1" :done="step > 1" title="Registro de compra">
      <div class="">
        <q-form @submit="setCompra()" class="q-pa-lg row">
          <q-input
            outlined
            type="text"
            v-model="folio"
            class="col-3 q-mr-md"
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Folio</small>
              <small class="text-red"> *</small></template
            >
          </q-input>
          <q-input
            outlined
            type="textarea"
            v-model="descripcion"
            class="col-5"
            label-slot
            lazy-rules
            :rules="[
              (val) => (val && val.length > 0) || 'Please type something',
            ]"
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Descripcion</small>
              <small class="text-red q-px-xl"> *</small></template
            >
          </q-input>
          <q-input
            outlined
            type="date"
            v-model="fecha_vencimiento"
            class="col-4 q-mr-md"
            lazy-rules
            dense="dense"
            required
          >
            <template v-slot:before>
              <small>Fecha de vencimiento</small>
              <small class="text-red"> *</small></template
            >
          </q-input>
        </q-form>
      </div>
    </q-step>

    <q-step :name="2" :done="step > 1" title="Registro de compra">
      <div class="bg-grey-2" flat>
        <div class="q-pa-md col-lg-4">
          <h6 class="text-grey-9">Detalle de la compra</h6>
          <q-markup-table flat dense class="q-mb-md">
            <tr>
              <th class="text-left">Folio</th>
              <td class="text-left">{{ folio }}</td>
            </tr>

            <tr>
              <th class="text-left">Descripción</th>
              <td class="text-left">{{ descripcion }}</td>
            </tr>

            <tr>
              <th class="text-left">Fecha de vencimiento</th>
              <td class="text-left">
                {{ fecha_vencimiento }}
              </td>
            </tr>
          </q-markup-table>
        </div>
      </div>
      <div>
        <q-btn
          class="bg-primary text-white q-ma-lg"
          @click="modalProductos = true"
        >
          Agregar producto</q-btn
        >
        <q-dialog v-model="modalProductos">
          <AgregarProductos />
        </q-dialog>
      </div>
    </q-step>
  </q-stepper>
</template>

<script>
import { ref } from "vue";
import { api } from "boot/axios";
import AgregarProductos from "./AgregarProductos.vue";
export default {
  name: "Formulario-component",
  setup() {
    return {
      step: ref(1),
      folio: ref(null),
      descripcion: ref(null),
      fecha_vencimiento: ref(null),
      modalProductos: ref(false),
    };
  },
  methods: {
    async setCompra() {
      const nuevoCompra = {
        factura_folio: this.folio,
        descripcion: this.descripcion,
        fecha_vencimiento: this.fecha_vencimientos,
      };
      try {
        await api.post("http://localhost:8080/api/compras/nuevo", nuevoCompra, {
          params: {
            api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
          },
        });
        console.log("Guardando nueva almacen...");
        this.$router.push("/compras");
        router.go(-1);
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
  },
  unmounted() {
    this.$emit("reload", true);
  },
  components: { AgregarProductos },
};
</script>

<style>
</style>