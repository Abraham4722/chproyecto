<template>
  <nav class="navbar navbar-expand-lg text-uppercase fs-6 p-3 border-bottom align-items-center" style="background-color:#010c2a;">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">
        
        <!-- Logo -->
        <div class="col-auto">
          <router-link class="navbar-brand text-white" to="/">
            <img src="@/plantilla/images/logo.jpg" alt="Logo" style="width: 50px; height: 50px;">
          </router-link>
        </div>

        <!-- Menú de categorías (Desktop) -->
        <div class="col-auto d-none d-lg-block">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown mx-2">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Playeras
              </a>
              <ul class="dropdown-menu">
                <li><router-link class="dropdown-item" to="/playeras/todas">Todas</router-link></li>
                <li><router-link class="dropdown-item" to="/playeras/manga-corta">Manga Corta</router-link></li>
                <li><router-link class="dropdown-item" to="/playeras/manga-larga">Manga Larga</router-link></li>
                <li><router-link class="dropdown-item" to="/playeras/oversize">Oversize</router-link></li>
              </ul>
            </li>
            <li class="nav-item dropdown mx-2">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Gorras
              </a>
              <ul class="dropdown-menu">
                <li><router-link class="dropdown-item" to="/gorras/todas">Todas</router-link></li>
                <li><router-link class="dropdown-item" to="/gorras/ajustables">Ajustables</router-link></li>
                <li><router-link class="dropdown-item" to="/gorras/snapback">Snapback</router-link></li>
              </ul>
            </li>
            <li class="nav-item dropdown mx-2">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Sudaderas
              </a>
              <ul class="dropdown-menu">
                <li><router-link class="dropdown-item" to="/sudaderas/todas">Todas</router-link></li>
                <li><router-link class="dropdown-item" to="/sudaderas/con-capucha">Con capucha</router-link></li>
                <li><router-link class="dropdown-item" to="/sudaderas/sin-capucha">Sin capucha</router-link></li>
              </ul>
            </li>
            <li class="nav-item dropdown mx-2">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Accesorios
              </a>
              <ul class="dropdown-menu">
                <li><router-link class="dropdown-item" to="/accesorios/todos">Todos</router-link></li>
                <li><router-link class="dropdown-item" to="/accesorios/billeteras">Billeteras</router-link></li>
                <li><router-link class="dropdown-item" to="/accesorios/cinturones">Cinturones</router-link></li>
              </ul>
            </li>
            <li class="nav-item mx-2">
              <router-link class="nav-link text-white" to="/pines">
                Pines
              </router-link>
            </li>
          </ul>
        </div>

        <!-- Menú Hamburguesa (Mobile) -->
        <div class="col-auto d-lg-none">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <!-- Carrito y Búsqueda -->
        <div class="col-3 col-lg-auto">
          <ul class="list-unstyled d-flex m-0 align-items-center">
            <!-- Búsqueda Desktop -->
            <li class="d-none d-lg-block me-4">
              <a href="#" @click.prevent="toggleSearch" class="text-white hover-effect">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </a>
            </li>
            
            <!-- Carrito Desktop - Icono más formal -->
            <li class="d-none d-lg-block">
              <div class="cart-icon-wrapper position-relative" @click="toggleCart">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span class="cart-badge" v-if="cartItems.length > 0">{{ cartItems.length }}</span>
              </div>
            </li>
            
            <!-- Iconos Mobile -->
            <li class="d-lg-none">
              <a href="#" class="mx-2 text-white" @click.prevent="toggleCart">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span class="cart-badge" v-if="cartItems.length > 0">{{ cartItems.length }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Barra de búsqueda desplegable -->
      <div class="search-dropdown" :class="{ 'active': searchOpen }">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
              <form class="search-form position-relative">
                <input type="text" class="form-control py-3 px-4" placeholder="Buscar playeras, gorras, accesorios..." 
                       style="border-radius: 30px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1)">
                <button class="btn position-absolute end-0 top-0 h-100 bg-transparent border-0" type="submit">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Carrito desplegable mejorado -->
    <div class="cart-dropdown" :class="{ 'active': cartOpen }">
      <div class="cart-header d-flex justify-content-between align-items-center p-3 border-bottom">
        <h5 class="m-0 fw-normal">TU CARRITO ({{ cartItems.length }})</h5>
        <button class="btn-close" @click="cartOpen = false"></button>
      </div>
      
      <div class="cart-body p-3">
        <div v-if="cartItems.length > 0" class="overflow-auto" style="max-height: 60vh;">
          <div class="d-flex align-items-center py-3 border-bottom" v-for="(item, index) in cartItems" :key="index">
            <img :src="item.image" :alt="item.name" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
            <div class="flex-grow-1">
              <h6 class="mb-1">{{ item.name }}</h6>
              <p class="mb-1 text-muted small">{{ item.quantity }} × ${{ item.price.toFixed(2) }}</p>
            </div>
            <button class="btn btn-sm btn-outline-danger" @click="removeItem(index)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
            </button>
          </div>
        </div>
        <div v-else class="text-center py-5">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="1.5">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
          </svg>
          <p class="mt-3 text-muted">Tu carrito está vacío</p>
          <router-link to="/playeras" class="btn btn-dark mt-2" @click="cartOpen = false">
            Comenzar a comprar
          </router-link>
        </div>
      </div>
      
      <div class="cart-footer p-3 border-top" v-if="cartItems.length > 0">
        <div class="d-flex justify-content-between mb-3">
          <span>Subtotal:</span>
          <span class="fw-bold">${{ cartTotal.toFixed(2) }}</span>
        </div>
        <router-link to="/checkout" class="btn btn-dark w-100 py-2" @click="cartOpen = false">
          Finalizar compra
        </router-link>
      </div>
    </div>
  </nav>
  
  <!-- Offcanvas Menu con categorías completas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title">Menú</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav">
        <li class="nav-item dropdown mb-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Playeras
          </a>
          <ul class="dropdown-menu">
            <li><router-link class="dropdown-item" to="/playeras/todas">Todas</router-link></li>
            <li><router-link class="dropdown-item" to="/playeras/manga-corta">Manga Corta</router-link></li>
            <li><router-link class="dropdown-item" to="/playeras/manga-larga">Manga Larga</router-link></li>
            <li><router-link class="dropdown-item" to="/playeras/oversize">Oversize</router-link></li>
          </ul>
        </li>
        <li class="nav-item dropdown mb-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Gorras
          </a>
          <ul class="dropdown-menu">
            <li><router-link class="dropdown-item" to="/gorras/todas">Todas</router-link></li>
            <li><router-link class="dropdown-item" to="/gorras/ajustables">Ajustables</router-link></li>
            <li><router-link class="dropdown-item" to="/gorras/snapback">Snapback</router-link></li>
          </ul>
        </li>
        <li class="nav-item dropdown mb-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Sudaderas
          </a>
          <ul class="dropdown-menu">
            <li><router-link class="dropdown-item" to="/sudaderas/todas">Todas</router-link></li>
            <li><router-link class="dropdown-item" to="/sudaderas/con-capucha">Con capucha</router-link></li>
            <li><router-link class="dropdown-item" to="/sudaderas/sin-capucha">Sin capucha</router-link></li>
          </ul>
        </li>
        <li class="nav-item dropdown mb-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Accesorios
          </a>
          <ul class="dropdown-menu">
            <li><router-link class="dropdown-item" to="/accesorios/todos">Todos</router-link></li>
            <li><router-link class="dropdown-item" to="/accesorios/billeteras">Billeteras</router-link></li>
            <li><router-link class="dropdown-item" to="/accesorios/cinturones">Cinturones</router-link></li>
          </ul>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/pines">
            Pines
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchOpen: false,
      cartOpen: false,
      cartItems: [] // Inicializado vacío, se llena en mounted
    }
  },
  computed: {
    cartTotal() {
      return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
  },
  methods: {
    toggleSearch() {
      this.searchOpen = !this.searchOpen;
      if (this.searchOpen) {
        this.cartOpen = false;
      }
    },
    toggleCart() {
      this.cartOpen = !this.cartOpen;
      if (this.cartOpen) {
        this.searchOpen = false;
      }
    },
    removeItem(index) {
      this.cartItems.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(this.cartItems));
    }
  },
  mounted(){
    const savedCart = JSON.parse(localStorage.getItem('cart'));
    this.cartItems = savedCart || [];
  }
}
</script>

<style scoped>
/* Efecto hover para iconos */
.hover-effect {
  transition: all 0.2s ease;
  opacity: 0.8;
}
.hover-effect:hover {
  opacity: 1;
  transform: scale(1.1);
}

/* Carrito desplegable mejorado */
.cart-dropdown {
  position: fixed;
  top: 0;
  right: 0;
  width: 100%;
  max-width: 380px;
  height: 100vh;
  background: white;
  z-index: 1100;
  transform: translateX(100%);
  transition: transform 0.3s ease;
  display: flex;
  flex-direction: column;
}

.cart-dropdown.active {
  transform: translateX(0);
}

.cart-body {
  flex: 1;
  overflow-y: auto;
}

/* Barra de búsqueda */
.search-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  padding: 1rem 0;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  transform: translateY(-20px);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
  z-index: 1050;
}

.search-dropdown.active {
  transform: translateY(0);
  opacity: 1;
  visibility: visible;
}

/* Badge del carrito */
.cart-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #dc3545;
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  font-size: 0.7rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

.cart-icon-wrapper {
  cursor: pointer;
  transition: transform 0.2s ease;
}

.cart-icon-wrapper:hover {
  transform: scale(1.05);
}

/* Transiciones suaves */
.nav-link, .dropdown-item {
  transition: all 0.2s ease;
}

/* Estilo para el offcanvas */
.offcanvas {
  max-width: 300px;
}

@media (min-width: 992px) {
  .navbar-nav .nav-item {
    position: relative;
  }
  
  .navbar-nav .nav-item:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: white;
    transition: all 0.3s ease;
  }
  
  .navbar-nav .nav-item:hover:after {
    width: 100%;
    left: 0;
  }
}
</style>    