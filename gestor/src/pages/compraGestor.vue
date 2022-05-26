<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Alta de compra"
        to="/compras/nueva"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Compras</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Compras" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <tablaCompras
    :columns="columns"
    :rows="rows"
    @reload="getStatus"
    :verDetalle="verDetalle"
  />
</template>

<script>
import { ref } from "vue";
import tablaCompras from "../components/compras/tablaCompras.vue";
import { api } from "boot/axios";
import FormularioCompra from "../components/compras/FormularioCompra.vue";
import verDetalle from "../components/compras/VistaDetalle.vue";

export default {
  name: "comprasView",
  setup() {
    return {};
  },
  data() {
    return {
      rows: [],
      columns: [
        {
          name: "serie_folio",
          label: "SERIE",
          field: (row) => row.serie_folio,
        },
        {
          name: "factura_folio",
          label: "FACTURA",
          field: (row) => row.factura_folio,
        },
        {
          name: "descripcion",
          label: "DESCRIPCION",
          field: (row) => row.descripcion,
        },
        {
          name: "cantidad_total",
          label: "TOTAL",
          field: (row) => row.cantidad_total,
        },
        {
          name: "costo_total_sin_iva",
          label: "TOTAL (Sin IVA)",
          field: (row) => row.costo_total_sin_iva,
        },
        {
          name: "costo_total_con_iva",
          label: "TOTAL (Sin IVA)",
          field: (row) => row.costo_total_con_iva,
        },

        {
          name: "importe_pagado",
          label: "PAGADO",
          field: (row) => row.importe_pagado,
        },

        {
          name: "importe_saldo",
          label: "SALDO",
          field: (row) => row.importe_saldo,
        },

        {
          name: "fecha_vencimiento",
          label: "FECHA VENCIMIENTO",
          field: (row) => row.fecha_vencimiento,
        },

        {
          name: "status",
          label: "STATUS",
          field: "status",
          sortable: true,
        },
        {
          name: "registro",
          align: "center",
          label: "REGISTRO",
          field: (row) => row.registro_fecha + " | " + row.autor,
          sortable: true,
        },
      ],

      verDetalle: verDetalle,
    };
  },
  components: {
    tablaCompras,
  },
  computed: {},
  methods: {
    async obtenerDatos() {
      try {
        const respuesta = await api.get(
          "http://localhost:8080/api/compras/index",
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        console.log("api conectada");
        this.rows = respuesta.data;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    getStatus(instruction) {
      if (instruction) {
        console.log("reloading");
        this.obtenerDatos();
      }
    },
  },
  created() {
    this.obtenerDatos();
    this.getStatus();
  },
};
</script>

<style>
</style>