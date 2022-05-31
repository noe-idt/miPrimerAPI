<template>
  <div>
    <div class="q-pa-md q-gutter-sm bg-grey-3 text-weight-medium text-black">
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
        @click="comprobarCompra"
        v-close-popup
      />
      <q-btn
        v-if="step > 1"
        flat
        color="primary"
        @click="$refs.stepper.previous()"
        label="Regresar"
        class="q-ml-sm float-right"
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
        <q-form
          @submit="comprobarCompra()"
          class="q-pa-lg column"
          style="max-width: 500px"
        >
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
            type="text"
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

    <q-step :name="2" :done="step > 1" title="Agregar Productos">
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
        <q-dialog v-model="modalProductos" persistent>
          <AgregarProductos @productosCompra="addProductos" />
        </q-dialog>
      </div>
      <q-markup-table
        flat
        dense
        class="q-mb-md"
        v-for="producto in listaProductos"
        :key="producto.producto_id"
      >
        <tr>
          <th class="text-left">Nombre</th>
          <td class="text-left">{{ producto.nombre }}</td>
        </tr>

        <tr>
          <th class="text-left">Importe</th>
          <td class="text-left">{{ "$" + producto.precio }}</td>
        </tr>

        <tr>
          <th class="text-left">Cantidad</th>
          <td class="text-left">
            {{ producto.cantidad }}
          </td>
        </tr>
        <tr>
          <th class="text-left">Subtotal</th>
          <td class="text-left">
            {{ "$" + subtotalComputado(producto) + ".00" }}
          </td>
        </tr>
        <tr>
          <th class="text-left">Total</th>
          <td class="text-left">
            {{ "$" + totalComputado(producto) }}
          </td>
        </tr>
        <tr>
          <th class="text-left"></th>
          <td class="text-left">
            <q-btn
              color="primary"
              class="q-ma-md float-left"
              @click="modalEditar(producto)"
            >
              Editar Producto
            </q-btn>
            <q-btn
              @click="quitarProducto(producto)"
              color="primary"
              class="q-ma-md float-left"
            >
              <q-item-section> Eliminar Producto </q-item-section>
            </q-btn>
          </td>
        </tr>
      </q-markup-table>
    </q-step>
  </q-stepper>
  <q-dialog v-model="alert">
    <EditarCantidad
      :producto="seleccionado"
      @datosNuevos="modificarProductos"
    />
  </q-dialog>
  <q-dialog v-model="finalStep">
    <q-card class="q-pa-lg" style="max-width: 80vw">
      <header style="width: 100%">
        <q-btn
          :ripple="false"
          icon="close"
          class="float-right"
          flat
          v-close-popup
        ></q-btn>

        <h6 class="q-ma-xs">Resumen de Compra</h6>
        <q-separator />
        <p class="text-grey-9">
          Estás a punto de generar una compra con los siguientes datos
        </p>
      </header>
      <body style="width: 100%">
        <q-markup-table flat class="q-mb-md">
          <tr>
            <th class="text-left">Folio</th>
            <td class="text-left">{{ folio }}</td>
          </tr>

          <tr>
            <th class="text-left">Descripción</th>
            <td class="text-left">{{ descripcion }}</td>
          </tr>

          <tr>
            <th class="text-left">Cantidad de productos</th>
            <td class="text-left">
              {{ calcularTotalProductos() }}
            </td>
          </tr>

          <tr>
            <th class="text-left">Total de compra:</th>
            <td class="text-left">
              {{ "$" + calcularTotal() }}
            </td>
          </tr>
        </q-markup-table>
        <q-btn
          color="primary"
          label="Guardar"
          class="float-right q-ml-xs"
          @click="setCompra()"
          v-close-popup
        />
        <q-btn
          flat
          no-caps
          color="primary"
          label="Cerrar"
          class="q-ml-sm float-right"
          v-close-popup
        />
      </body>
    </q-card>
  </q-dialog>
  <q-dialog v-model="error">
    <q-card class="" style="max-width: 80vw">
      <div class="text-h6" style="width: 100%">
        <q-btn
          :ripple="false"
          icon="close"
          class="float-right"
          flat
          v-close-popup
        ></q-btn>
        <q-badge
          class="bg-red-1 text-red-6 q-ma-lg q-pa-md"
          outline
          style="width: 90%"
        >
          <q-icon name="o_warning_amber" class="q-mr-md" size="30px"></q-icon>
          <span>La compra debe contener al menos un producto</span>
        </q-badge>
      </div>
    </q-card>
  </q-dialog>
</template>

<script>
import { ref } from "vue";
import { api } from "boot/axios";
import AgregarProductos from "./AgregarProductos.vue";
import EditarCantidad from "./EditarCantidad.vue";
export default {
  name: "Formulario-component",
  setup() {
    return {
      step: ref(1),
      folio: ref(null),
      descripcion: ref(null),
      fecha_vencimiento: ref(null),
      modalProductos: ref(false),
      listaProductos: ref([]),
      seleccionado: ref(null),
      alert: ref(false),
      finalStep: ref(false),
      error: ref(false),
    };
  },
  methods: {
    async setCompra() {
      const nuevoCompra = {
        factura_folio: this.folio,
        compra_id: nanoid(12),

        descripcion: this.descripcion,
        fecha_vencimiento: this.fecha_vencimientos,
        productos: this.listaProductos,
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
    addProductos(instruction) {
      this.listaProductos = [];
      this.listaProductos = instruction;
    },
    modificarProductos(nuevosDatos) {
      const encontrado = this.listaProductos.find(
        (prod) => prod.producto_id === nuevosDatos.producto_id
      );
      if (encontrado === undefined) {
        //el producto no se encuentra en el array
      } else {
        encontrado.cantidad = nuevosDatos.cantidad;
        encontrado.precio = nuevosDatos.precio;
      }
    },
    totalComputado(producto) {
      let subtotal = this.subtotalComputado(producto);
      let total = subtotal + subtotal * 0.16;
      return total.toFixed(2);
    },
    subtotalComputado(producto) {
      return producto.cantidad * producto.precio;
    },
    quitarProducto(producto) {
      this.listaProductos = this.listaProductos.filter(
        (busqueda) => busqueda.producto_id != producto.producto_id
      );
    },
    modalEditar(producto) {
      this.seleccionado = producto;
      this.alert = true;
    },
    comprobarCompra() {
      console.log("submitted");

      if (this.listaProductos.length == 0) {
        this.error = true;
      } else {
        this.finalStep = true;
      }
    },
    calcularTotal() {
      let total = 0;
      let subtotal = 0;
      let subtotalIva = 0;
      this.listaProductos.forEach(function (producto) {
        subtotal = producto.cantidad * producto.precio;
        subtotalIva = subtotal + subtotal * 0.16;
        total = total + subtotalIva;
      });

      return total.toFixed(2);
    },
    calcularTotalProductos() {
      let totalProductos = 0;
      this.listaProductos.forEach(function (producto) {
        totalProductos = producto.cantidad + producto.cantidad;
      });

      return totalProductos;
    },
  },
  unmounted() {
    this.$emit("reload", true);
  },
  components: { AgregarProductos, EditarCantidad },
  computed: {},
};
</script>

<style>
</style>