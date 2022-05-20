
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
    path: '/marcas',
    name: 'Marcas',
    component: () => import('../pages/marcaGestor.vue')
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
