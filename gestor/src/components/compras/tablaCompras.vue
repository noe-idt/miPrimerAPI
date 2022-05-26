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
      <template v-slot:body-cell-serie_folio="props">
        <q-td :props="props">
          <router-link
            :to="{ name: 'Compra', params: { id: props.row.compra_id } }"
            >{{ props.row.serie_folio }}</router-link
          >
        </q-td>
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

    verDetalle: ref(null),
  },
  setup() {
    return {
      separator: ref("cell"),
      search: ref(""),

      modalDetalle: ref(false),
    };
  },
  methods: {
    getStatus(instruction) {
      console.log(instruction);
      this.$emit("reload", true);
    },
    truncateString(str, num) {
      if (str.length <= num) {
        return str;
      }
      return str.slice(0, num) + "...";
    },
  },
  components: {},
  computed: {},
};
</script>

<style>
</style>