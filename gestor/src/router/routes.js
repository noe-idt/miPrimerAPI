
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') }
    ]
  },
  {
    path: '/usuarios',
    name: 'usuarios',
    component: () => import('../pages/usuarios.vue')
  },
  {
    path: '/productos',
    name: 'Productos',
    component: () => import('../pages/productoGestor.vue')
  },
  {
    path: '/marcas',
    name: 'Marcas',
    component: () => import('../pages/marcaGestor.vue')
  },
  { 
    path: '/perfiles',
  name: 'Perfiles',
  component: () => import('../pages/perfilGestor.vue')
  },
  { 
    path: '/perfiles/:id',
    name: 'Perfil',
    component: () => import('../components/perfiles/verDetallePerfil.vue')
  },
  { 
    path: '/categorias',
  name: 'Categorias',
  component: () => import('../pages/categoriaGestor.vue')
  },
  { 
    path: '/tiendas',
  name: 'Tiendas',
  component: () => import('../pages/tiendaGestor.vue')
  },
  { 
    path: '/tiendas/:id',
    name: 'Tienda',
    component: () => import('../components/tiendas/VistaDetalle.vue')
  },
  { 
    path: '/tiendas/nueva',
    name: 'Alta de Tienda',
    component: () => import('../components/tiendas/FormularioTienda.vue')
  },
  { 
    path: '/tiendas/editar/:id',
    name: 'Editar Tienda',
    component: () => import('../components/tiendas/FormularioEditarTienda.vue')
  },
  { 
    path: '/compras/',
    name: 'Compras',
    component: () => import('../pages/compraGestor.vue')
  },
  { 
    path: '/compras/nueva',
    name: 'Alta de Compra',
    component: () => import('../components/compras/FormularioCompra.vue')
  },
  { 
    path: '/compras/:id',
    name: 'Compra',
    component: () => import('../components/compras/VistaDetalle.vue')
  },
  /*{ 
    path: '/almacenes',
  name: 'Almacenes',
  component: () => import('../pages/almacenGestor.vue')
  },
  { 
    path: '/almacenes/nuevo',
    name: 'Alta de Almacen',
    component: () => import('../components/almacenes/FormularioAlmacen.vue')
  },
  { 
    path: '/almacenes/editar/:id',
    name: 'Editar Almacen',
    component: () => import('../components/almacenes/FormularioEditarAlmacen.vue')
  },*/
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
