<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
      <q-btn
        class="float-right"
        color="primary"
        label="Regresar"
        to="/perfiles"
      ></q-btn>
      <h5 class="q-my-none q-mx-lg">Detalle de perfil</h5>

      <div class="q-gutter-sm">
        <q-breadcrumbs>
          <q-breadcrumbs-el label="Home" />
          <q-breadcrumbs-el label="Perfiles" />
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
          <q-item-label caption> {{ clave }} </q-item-label>
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
      <q-btn-dropdown flat class="q-pa-xs" label="Menu" dropdown-icon="menu">
        <q-list>
          <q-item clickable @click="FormEditar = true">
            <q-dialog v-model="FormEditar" persistent>
              <FormularioEditar
                :id="this.$route.params.id"
                @reload="getStatus"
              />
            </q-dialog>
            <q-item-section>
              <q-item-label>
                <q-icon name="edit"> </q-icon>
                Editar Perfil
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item clickable @click="FormEliminar = true">
            <q-dialog v-model="FormEliminar" persistent>
              <FormularioEliminar
                :id="this.$route.params.id"
                @reload="getStatus"
              />
            </q-dialog>
            <q-item-section>
              <q-item-label>
                <q-icon name="delete"> </q-icon>Eliminar Perfil
              </q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-btn-dropdown>
    </q-card>
  </q-card>
</template>

<script>
import FormularioEditar from "./FormularioEditarPerfil.vue";
import FormularioEliminar from "./FormularioEliminarPerfil.vue";
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
      FormEditar: ref(false),
      FormEliminar: ref(false),
    };
  },
  methods: {
    async obtenerDatos() {
      try {
        const perfil = this.$route.params.id;
        const respuesta = await api.get(
          `http://localhost:8080/api/perfiles/${perfil}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );

        console.log("Perfil Obtenido");
        const datosPerfil = respuesta.data[0];
        this.nombre = datosPerfil.nombre;
        this.clave = datosPerfil.clave;
        this.descripcion = datosPerfil.descripcion;
        this.fecha_reg = datosPerfil.registro_fecha;
        this.autor = datosPerfil.autor;
        this.fecha_actu = datosPerfil.actualizacion_fecha;
        this.autor_act = datosPerfil.autor_act;
        this.status = datosPerfil.status;
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
  components: { FormularioEliminar, FormularioEditar },
};
</script>

<style>
</style>