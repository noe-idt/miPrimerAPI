<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Regresar"
        to="/almacenes"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Detalle de Almacen</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Almacenes" />
          <q-breadcrumbs-el label="Detalle" class="text-primary" />
        </q-breadcrumbs>
      </div>
    </div>
  </div>
  <q-card class="q-pa-lg q-ma-lg bg-grey-1">
    <header class="text-h6 text-center">
      {{ nombre }}
    </header>
    <q-card class="my-card bg-grey-1" flat bordered>
      <q-item>
        <q-item-section>
          <q-item-label>{{ nombre }}</q-item-label>
          <q-item-label>{{ nombre_comercial }}</q-item-label>
          <q-item-label caption> {{ clave }} </q-item-label>
          <q-item-label> {{ direccion }} </q-item-label>
          <q-item-label> Gerente: {{ gerente_nombre }} </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-card-section horizontal>
        <q-card-section> Registrado por : {{ autor }} </q-card-section>

        <q-separator vertical />

        <q-card-section class="col-4">
          Fecha de registro: {{ fecha_reg }} <br />
          Status: {{ status }}
        </q-card-section>
      </q-card-section>

      <q-card-section horizontal>
        <q-card-section> Actualizado por : {{ autor_act }} </q-card-section>

        <q-separator vertical />

        <q-card-section class="col-4">
          Fecha de actualizacion: {{ fecha_actu }} <br />
        </q-card-section>
      </q-card-section>
      <q-card-section>
        <div class="q-pa-md">
          <q-btn
            color="primary"
            class="q-ma-md float-right"
            :disable="status === 300 ? '' : 'true'"
            :to="{
              name: 'Editar Almacen',
              params: { id: this.$route.params.id },
            }"
          >
            Editar Almacen
          </q-btn>
          <q-btn
            @click="FormEliminar = true"
            color="primary"
            :disable="status === 300 ? '' : 'true'"
            class="q-ma-md float-right"
          >
            <q-dialog v-model="FormEliminar" persistent>
              <FormularioEliminar
                :id="this.$route.params.id"
                @reload="getStatus"
              />
            </q-dialog>
            <q-item-section> Eliminar Almacen </q-item-section>
          </q-btn>
        </div>
      </q-card-section>
    </q-card>
  </q-card>
</template>

<script>
import FormularioEliminar from "./FormularioEliminarAlmacen.vue";
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
      FormEliminar: ref(false),
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const almacen = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/almacenes/${almacen}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Almacen Obtenido");
        const datosAlmacen = respuesta.data[0];
        this.nombre = datosAlmacen.nombre;
        this.clave = datosAlmacen.clave;
        this.direccion = datosAlmacen.direccion;
        this.fecha_reg = datosAlmacen.registro_fecha;
        this.autor = datosAlmacen.autor;
        this.fecha_actu = datosAlmacen.actualizacion_fecha;
        this.autor_act = datosAlmacen.autor_act;
        this.status = datosAlmacen.status;
        this.gerente_nombre = datosAlmacen.gerente_nombre;
        this.nombre_comercial = datosAlmacen.nombre_comercial;
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
  },
  props: {
    id: String,
  },
  components: { FormularioEliminar },
};
</script>

<style>
</style>