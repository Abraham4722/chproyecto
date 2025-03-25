<template>
    
  <nav class="navbar navbar-expand-lg  text-uppercase fs-6 p-3 border-bottom align-items-center" style="background-color:#010c2a ;">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">

        <div class="col-auto">
          <a class="navbar-brand text-white" href="index.html">
           <img src="@/plantilla/images/logo.jpg" alt="" style="width: 50px; height: 50px;">
          </a>
        </div>

        <div class="col-auto">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                <li class="nav-item dropdown">
                  <a class="text-white nav-link dropdown-toggle active" href="#" id="dropdownHome" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Home</a>
                  <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownHome">
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Home Layout 1</a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Home Layout 2 </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Home Layout 3 </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Home Layout 4 </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="text-white nav-link dropdown-toggle" href="#" id="dropdownShop" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Shop</a>
                  <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownShop">
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Sidebar </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Three Column </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Three Column Wide </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Four Column </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Four Column Wide </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Six Column </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Shop Six Column Wide </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Single Product </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Single Product V2 </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="text-white nav-link dropdown-toggle" href="#" id="dropdownBlog" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Blog</a>
                  <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownBlog">
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Blog Classic </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Blog Grid with Sidebar </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Blog Grid Four Column </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Blog No Sidebar </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Blog Right Sidebar </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Single Post </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Single Post No Sidebar </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="text-white nav-link dropdown-toggle" href="#" id="dropdownPages" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Pages</a>
                  <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownPages">
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">About </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Cart </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Checkout </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Coming Soon </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Contact </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Error Page </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">FAQs </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">My Account </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Order Tracking </a>
                    </li>
                    <li>
                      <a href="index.html" class="dropdown-item item-anchor">Wishlist </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="text-white nav-link" href="#">Blog</a>
                </li>
                <li class="text-white nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-3 col-lg-auto">
          <ul class="list-unstyled d-flex m-0">
            <li class="d-none d-lg-block">
              <a href="index.html" class="text-white text-uppercase mx-3">Wishlist <span class="wishlist-count">(0)</span>
              </a>
            </li>
            <li class="d-none d-lg-block">
              <a href="index.html" class="text-white text-uppercase mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">Cart <span class="cart-count">(0)</span>
              </a>
            </li>
            <li class="d-lg-none">
              <a href="#" class="mx-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#heart"></use>
                </svg>
              </a>
            </li>
            <li class="d-lg-none">
              <a href="#" class="mx-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </a>
            </li>
            <li class="search-box mx-2">
              <a href="#search" class="search-button">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#search"></use>
                </svg>
              </a>
            </li>
          </ul>
        </div>

      </div>

    </div>
  </nav>
    <div class="product-details container">
      <div class="row">
        <!-- Imagen principal -->
        <div class="col-md-6">
          <img src="@/plantilla/images/palmR.jpg" :alt="product.name" class="img-fluid main-image" />
        </div>
  
        <!-- Información del producto -->
        <div class="col-md-6">
          <span class="badge bg-secondary">NUEVO</span>
          <h2 class="product-title">{{ product.name }}</h2>
          <p class="product-price">${{ product.price }}</p>
          
          <!-- Colores disponibles -->
          <div class="colors">
            <h5>Colores</h5>
            <div class="d-flex">
                <img class="color-option" src="@/plantilla/images/palmR.jpg" alt="">
                <img class="color-option" src="@/plantilla/images/palmR.jpg" alt="">
                <img class="color-option" src="@/plantilla/images/palmR.jpg" alt="">
                <img class="color-option" src="@/plantilla/images/palmR.jpg" alt="">
            
            </div>
          </div>
  
          <!-- Tallas disponibles -->
          <div class="sizes">
            <h5>Tallas</h5>
            <div class="d-flex">
              <button 
                v-for="size in product.sizes" 
                :key="size" 
                class="size-btn" 
                :class="{ 'disabled': !size.available }"
                @click="selectSize(size)"
              >
                {{ size.label }}
              </button>
            </div>
          </div>
  
          <!-- Botón de añadir al carrito -->
          <button class="add-to-cart">AÑADIR AL CARRITO</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        product: {
          name: "Playera Palm Angels",
          price: 899,
          image: "@/assets/product-main.jpg",
          colors: [
            { name: "Blanco", image: "@/plantilla/images/palmR.jpg" },
            { name: "Azul", image: "@/plantilla/images/palmR.jpg" },
            { name: "Rojo", image: "@/plantilla/images/palmR.jpg" }
          ],
          sizes: [
            { label: "XS", available: false },
            { label: "S", available: true },
            { label: "M", available: true },
            { label: "L", available: true },
            { label: "XL", available: true },
            { label: "2XL", available: false }
          ]
        }
      };
    },
    methods: {
      selectColor(color) {
        console.log("Color seleccionado:", color.name);
      },
      selectSize(size) {
        if (size.available) {
          console.log("Talla seleccionada:", size.label);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .product-details {
    padding: 20px;
  }
  .main-image {
    width: 100%;
    border-radius: 10px;
  }
  .color-option {
    width: 50px;
    height: 50px;
    margin-right: 10px;
    cursor: pointer;
    border-radius: 5px;
  }
  .size-btn {
    padding: 10px 20px;
    margin: 5px;
    border: 1px solid #000;
    cursor: pointer;
    background-color: white;
  }
  .size-btn.disabled {
    opacity: 0.5;
    pointer-events: none;
  }
  .add-to-cart {
    width: 100%;
    padding: 15px;
    background-color: black;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    margin-top: 20px;
  }
  </style>
