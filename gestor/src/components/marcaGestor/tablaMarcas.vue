<template>
  <div class="q-pa-md">
    <div class="q-gutter-y-md q-my-md q-mx-xl row">
      <q-input outlined dense debounce="400" v-model="search" class="col-4">
        <template v-slot:append>
          <q-icon
            v-if="text !== ''"
            name="close"
            @click="text = ''"
            class="cursor-pointer"
          />
          <q-icon name="search" />
        </template>
      </q-input>
      <q-btn
        outline
        color="grey-8"
        icon="autorenew"
        label="Limpiar"
        class="bg-grey-3 q-mx-lg"
      />
      <q-btn
        outline
        color="grey-8"
        icon="filter_alt"
        label="Filtros"
        class="bg-grey-3"
      />
    </div>
  </div>

  <div class="q-px-xl" :class="tableFormat">
    <q-table
      table-header-class="bg-grey-3 text-grey-9 "
      :rows="rows"
      :columns="columns"
      :row-key="columns[0].name"
      :separator="separator"
      :filter="search"
    >
      <template v-slot:body-cell-nombre="props">
        <q-td :props="props">
          <q-list>
            <q-item clickable @click="modalDetalle = true">
              <q-item-section>
                <q-item-label>
                  <q-icon name="delete"> </q-icon>Eliminar
                  {{ this.$route.name.slice(0, -1) }}</q-item-label
                >
              </q-item-section>
            </q-item>
          </q-list>
        </q-td>
        <q-dialog v-model="modalDetalle">
          <component :is="verDetalle" :id="props.key" />
        </q-dialog>
      </template>

      <template v-slot:body-cell-status="props">
        <q-td :props="props">
          <q-badge
            :color="
              props.row.status == 200
                ? 'green q-px-md q-py-xs'
                : 'red  q-px-sm q-py-xs'
            "
            :label="props.row.status == 200 ? 'ACTIVO' : 'INACTIVO'"
          >
          </q-badge
        ></q-td>
      </template>
      <template v-slot:body-cell-opciones="props">
        <q-td :props="props">
          <q-btn-dropdown flat class="q-pa-xs" dropdown-icon="menu">
            <q-list>
              <q-item clickable @click="FormEditar = true">
                <q-dialog v-model="FormEditar">
                  <component
                    :is="FormularioEditar"
                    :id="props.key"
                    @reload="getStatus"
                  />
                </q-dialog>
                <q-item-section>
                  <q-item-label>
                    <q-icon name="edit"> </q-icon>
                    Editar {{ this.$route.name.slice(0, -1) }}
                  </q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable @click="FormEliminar = true">
                <q-dialog v-model="FormEliminar">
                  <component
                    :is="FormularioEliminar"
                    :id="props.key"
                    @reload="getStatus"
                  />
                </q-dialog>
                <q-item-section>
                  <q-item-label>
                    <q-icon name="delete"> </q-icon>Eliminar
                    {{ this.$route.name.slice(0, -1) }}</q-item-label
                  >
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  name: "tablaComponente",
  props: {
    rows: ref(null),
    columns: {
      type: Array,
    },
    FormularioEditar: ref(null),
    FormularioEliminar: ref(null),
    verDetalle: ref(null),
  },
  setup() {
    return {
      separator: ref("cell"),
      search: ref(""),
      FormEditar: ref(false),
      FormEliminar: ref(false),
      modalDetalle: ref(false),
    };
  },
  methods: {
    getStatus(instruction) {
      console.log(instruction);
      this.$emit("reload", true);
    },
  },
  components: {},
};
</script>

<style>
</style>