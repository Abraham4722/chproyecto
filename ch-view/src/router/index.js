import { createRouter, createWebHistory } from 'vue-router'

// Vistas principales (usando lazy loading para mejor performance)
const HomeComponent = () => import('@/views/home/HomeComponent.vue')
const ContactComponent = () => import('@/views/contact/ContactComponent.vue')
const ProductsSingleComponent = () => import('@/views/products/ProductsSingleComponent.vue')
const VerColeccionComponent = () => import('@/views/products/VerColeccionComponent.vue')
const CheckoutComponent = () => import('@/views/products/CheckoutComponent.vue')
//const BrandProducts = () => import('@/views/brands/BrandProducts.vue')

const routes = [
  {
    path: '/',
    name: "index", 
    component: HomeComponent,
    meta: {
      title: 'Inicio'
    }
  },
  {
    path: '/contact',
    name: "contact", 
    component: ContactComponent,
    meta: {
      title: 'Contacto'
    }
  },
  {
    path: '/product/:slug',
    name: "product", 
    component: ProductsSingleComponent,
    props: true,
    meta: {
      title: 'Detalle de Producto'
    }
  },
  {
    path: '/colecciones',
    name: "colecciones", 
    component: VerColeccionComponent,
    meta: {
      title: 'Nuestras Colecciones'
    }
  },
  /*{
    path: '/marcas/:brandId',
    name: "brandProducts", 
    component: BrandProducts,
    props: true,
    meta: {
      title: 'Colección de Marca'
    }
  },
  */
  {
    path: '/checkout',
    name: "checkout", 
    component: CheckoutComponent,
    meta: {
      title: 'Finalizar Compra',
      requiresAuth: true
    }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { top: 0 }
  }
})

// Cambiar título de página dinámicamente
router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Mi Tienda Online'
  next()
})

export default router