<template>
  <div>
    <div class="q-pa-md bg-grey-3 text-weight-medium text-black">
      <q-btn-dropdown
        flat
        class="q-ml-md bg-white text-primary float-right"
        label="Menú"
        dropdown-icon="menu"
      >
        <q-list class="text-primary">
          <q-item clickable @click="FormDescuento = true">
            <q-dialog v-model="FormDescuento">
              <FormularioDescuento @descuento="getDescuento" />
            </q-dialog>
            <q-item-section>
              <q-item-label>
                <q-icon name="discount"> </q-icon>
                Agregar Descuento
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item clickable @click="FormEliminar = true">
            <q-dialog v-model="FormEliminar">
              <FormularioEliminar
                :id="this.$route.params.id"
                @reload="getStatus"
              />
            </q-dialog>
            <q-item-section>
              <q-item-label>
                <q-icon name="delete"> </q-icon>Eliminar
                {{ this.$route.name }}</q-item-label
              >
            </q-item-section>
          </q-item>
        </q-list>
      </q-btn-dropdown>
      <q-btn
        class="float-right"
        color="primary"
        label="Regresar"
        to="/compras"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Detalle de Compra</h5>
      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Compras" />
          <q-breadcrumbs-el label="Detalle" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-card class="q-pa-lg q-ma-lg row justify-center" flat>
    <div class="q-pa-md col-lg-4">
      <h6 class="text-grey-9">Datos generales de la compra</h6>
      <q-markup-table
        separator="cell"
        flat
        v-for="compra in arrCompras"
        :key="compra.compra_id"
      >
        <tr>
          <th class="text-left">Serie</th>
          <td class="text-left">{{ compra.serie }}</td>
        </tr>
        <tr>
          <th class="text-left">Folio</th>
          <td class="text-left">{{ compra.factura_folio }}</td>
        </tr>
        <tr>
          <th class="text-left">Descripción</th>
          <td class="text-left">{{ compra.descripcion }}</td>
        </tr>
        <tr>
          <th class="text-left">Cantidad Comprada</th>
          <td class="text-left">{{ compra.cantidad_total }}</td>
        </tr>
        <tr>
          <th class="text-left">Monto sin IVA</th>
          <td class="text-left">{{ "$" + compra.costo_total_sin_iva }}</td>
        </tr>
        <tr>
          <th class="text-left">Monto con IVA</th>
          <td class="text-left">{{ "$" + compra.costo_total_con_iva }}</td>
        </tr>
        <tr>
          <th class="text-left">Importe Pagado</th>
          <td class="text-left">{{ "$" + compra.importe_pagado }}</td>
        </tr>
        <tr>
          <th class="text-left">Importe Saldo</th>
          <td class="text-left">{{ "$" + compra.importe_saldo }}</td>
        </tr>
        <tr>
          <th class="text-left">Fecha de vencimiento</th>
          <td class="text-left">{{ compra.fecha_vencimiento }}</td>
        </tr>
        <tr>
          <th class="text-left">Status</th>
          <td class="text-left">
            <q-badge
              :color="
                compra.status == 200
                  ? 'green q-px-md q-py-xs'
                  : 'red  q-px-sm q-py-xs'
              "
              :label="compra.status == 200 ? 'ACTIVO' : 'INACTIVO'"
            >
            </q-badge>
          </td>
        </tr>
        <tr>
          <th class="text-left">Fecha de registro</th>
          <td class="text-left">
            {{ compra.registro_fecha + "  |  " + compra.autor }}
          </td>
        </tr>
      </q-markup-table>
    </div>
    <div class="q-pa-md col-lg-4">
      <h6 class="text-grey-9">Detalle de la compra</h6>
      <q-markup-table
        flat
        dense
        class="q-mb-md"
        v-for="detalle in detalles"
        :key="detalle.compra_detalle_id"
      >
        <tr>
          <th class="text-left">Nombre</th>
          <td class="text-left">{{ detalle.nombre }}</td>
        </tr>
        <tr>
          <th class="text-left">Descripción</th>
          <td class="text-left">{{ detalle.descripcion }}</td>
        </tr>
        <tr>
          <th class="text-left">Cantidad</th>
          <td class="text-left">{{ detalle.cantidad }}</td>
        </tr>
        <tr>
          <th class="text-left">Importe unitario</th>
          <td class="text-left">{{ "$" + detalle.importe_unitario }}</td>
        </tr>
        <tr>
          <th class="text-left">Importe sin IVA</th>
          <td class="text-left">{{ "$" + detalle.importe_total_sin_iva }}</td>
        </tr>
        <tr>
          <th class="text-left">Descuento</th>
          <td class="text-left">{{ "$" + detalle.descuento }}</td>
        </tr>
        <tr>
          <th class="text-left">Importe con IVA</th>
          <td class="text-left">{{ "$" + detalle.importe_total_con_iva }}</td>
        </tr>

        <tr>
          <th class="text-left">Fecha de registro</th>
          <td class="text-left">
            {{ detalle.registro_fecha + "  |  " + detalle.autor }}
          </td>
        </tr>
      </q-markup-table>
      <div class="q-pa-md">
        <q-btn
          color="primary"
          class="q-ma-md float-right"
          :disable="status === 300 ? '' : 'true'"
          :to="{
            name: 'Editar Compra',
            params: { id: this.$route.params.id },
          }"
        >
          Editar Compra
        </q-btn>
      </div>
    </div>
  </q-card>
</template>

<script>
import FormularioEliminar from "./FormularioEliminarCompra.vue";
import FormularioDescuento from "./FormularioDescuento.vue";

import { ref } from "vue";
import { api } from "boot/axios";

export default {
  name: "Formulario-component",
  setup() {
    return {
      step: ref(1),
      arrCompras: ref(null),
      detalles: ref(null),
      FormEliminar: ref(false),
      FormDescuento: ref(false),
    };
  },
  methods: {
    async obtenerDatosCompra() {
      try {
        const compra = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/compras/${compra}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Compra Obtenido");

        this.arrCompras = respuesta.data;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    async obtenerDatosDetalle() {
      try {
        const compra = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/compras/detalle/${compra}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("Detalle de la compra obtenido");
        this.detalles = respuesta.data;
      } catch (error) {}
    },
    getStatus(instruction) {
      if (instruction) {
        console.log("reloading");
        this.obtenerDatosCompra();
      }
    },
    getDescuento(descuento) {
      if (descuento) {
        console.log("discounting");
        this.aplicarDescuento();
      }
    },
    aplicarDescuento() {},
  },
  created() {
    this.obtenerDatosCompra();
    this.obtenerDatosDetalle();
  },
  props: {
    id: String,
  },
  components: { FormularioEliminar, FormularioDescuento },
};
</script>

<style>
tr:nth-child(even) {
  background-color: #b3c7d414 !important;
}
</style>