<template>
  <q-layout view="lHh Lpr lFf">
    <q-header>
      <q-tabs
        v-model="tab"
        inline-label
        align="left"
        indicator-color="grey-3"
        active-bg-color="grey-4"
        class="bg-grey-3 text-weight-medium text-black shadow-1 q-pa-xs"
      >
        <q-route-tab style="border-radius: 30px" to="/" label="Home" />
        <q-route-tab
          style="border-radius: 30px"
          to="/usuarios"
          label="Usuarios"
        />
        <q-route-tab style="border-radius: 30px" to="/marcas" label="Marcas" />

        <q-route-tab
          style="border-radius: 30px"
          to="/perfiles"
          label="Perfiles"
        />
        <q-route-tab
          style="border-radius: 30px"
          to="/categorias"
          label="Categorías"
        />
      </q-tabs>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "MainLayout",

  components: {},

  setup() {
    return {
      tab: ref(),
    };
  },
  data() {},
  methods: {},
});
</script>
