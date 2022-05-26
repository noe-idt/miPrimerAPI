<template>
  <div class="q-pa-md bg-white">
    <div class="q-gutter-y-md q-my-md q-mx-xl row">
      <q-input outlined dense debounce="400" v-model="search" class="col-7">
        <template v-slot:append>
          <q-icon
            v-if="text !== ''"
            name="close"
            @click="text = ''"
            class="cursor-pointer"
          />
          <q-btn icon="search" flat class="text-black" @click="busqueda" />
        </template>
      </q-input>
      <q-btn
        outline
        color="grey-8"
        icon="autorenew"
        label="Limpiar"
        class="bg-grey-3 q-mx-lg"
      />
    </div>
    <div class="q-pa-md">
      <q-markup-table flat bordered separator="cell">
        <thead class="bg-blue-grey-1">
          <tr>
            <th class="text-left">Nombre</th>
            <th class="text-right">Descripcion</th>
            <th class="text-right">Precio</th>
            <th></th>
          </tr>
        </thead>
        <tbody v-for="producto in productos" :key="producto.producto_id">
          <tr>
            <td class="text-left">{{ producto.nombre }}</td>
            <td class="text-right">{{ producto.descripcion }}</td>
            <td class="text-right">{{ "$" + producto.precio }}</td>
            <td class="text-right">
              <q-btn
                flat
                class="text-primary"
                label="Seleccionar"
                @click="agregarProducto"
              ></q-btn>
            </td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { api } from "boot/axios";

export default {
  name: "tablaComponente",

  setup() {
    return {
      search: ref(""),
      productos: ref(null),
      canasta: [],
    };
  },
  methods: {
    getStatus(instruction) {
      console.log(instruction);
      this.$emit("reload", true);
    },
    async busqueda() {
      try {
        let busqueda = this.search;
        const respuesta = await api.get(
          `http://localhost:8080/api/productos/buscar/${busqueda}`,
          {
            params: {
              api_key: "7aa8e437-4257-468a-8bd5-aafb9396ab53",
            },
          }
        );
        this.productos = respuesta.data;
      } catch (error) {
        console.log("No se pudo conectar" + error);
      }
    },
    agregarProducto() {
      const carrito = {
        nombre: producto.nombre,
        cantidad: 1,
        precio: producto.precio,
      };
      this.canasta.push(carrito);
      console.log(canasta);
    },
  },
  components: {},
};
</script>

<style>
tr:nth-child(even) {
  background-color: #b3c7d414 !important;
}
</style>