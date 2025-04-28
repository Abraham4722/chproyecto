<template>
  <div>
    <HeaderComponent :cart-count="cartCount" @open-cart="openCart" />
    
    <!-- Producto - Diseño minimalista -->
    <div class="product-container container py-5">
      <div class="row g-5">
        <!-- Galería de imágenes -->
        <div class="col-md-6">
          <div class="product-gallery">
            <div class="main-image-container">
              <img :src="currentImage" :alt="product.name" class="main-image img-fluid" @click="openLightbox">
            </div>
            <div class="thumbnail-container">
              <div class="thumbnail" v-for="(img, index) in product.images" :key="index" 
                   @click="changeImage(img)" :class="{ 'active': currentImage === img }">
                <img :src="img" :alt="'Thumbnail ' + (index + 1)" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
          <div class="product-details">
            <span class="badge">NEW</span>
            <h1 class="product-title">{{ product.name }}</h1>
            <p class="product-price">${{ product.price.toLocaleString() }}</p>
            
            <div class="divider"></div>

            <!-- Selector de color -->
            <div class="product-option">
              <h5>Color</h5>
              <div class="color-selector">
                <div class="color-circle" v-for="color in product.colors" :key="color.name"
                     :style="{ backgroundColor: color.code }"
                     :class="{ 'selected': selectedColor === color.name }"
                     @click="selectColor(color)">
                  <span class="color-tooltip">{{ color.name }}</span>
                </div>
              </div>
            </div>

            <!-- Selector de talla -->
            <div class="product-option">
              <h5>Talla</h5>
              <div class="size-selector">
                <button v-for="size in product.sizes" :key="size.label"
                        class="size-btn" 
                        :class="{ 
                          'selected': selectedSize === size.label,
                          'disabled': !size.available 
                        }"
                        @click="selectSize(size)">
                  {{ size.label }}
                </button>
              </div>
              <p class="size-guide" @click="openSizeGuide">Guía de tallas</p>
            </div>

            <!-- Cantidad y acciones -->
            <div class="product-actions">
              <div class="quantity-selector">
                <button class="quantity-btn" @click="decrementQuantity">−</button>
                <span class="quantity">{{ quantity }}</span>
                <button class="quantity-btn" @click="incrementQuantity">+</button>
              </div>
              <button class="add-to-cart-btn" @click="addToCart" :disabled="!selectedSize || addingToCart">
                <span v-if="!addingToCart">AÑADIR AL CARRITO</span>
                <span v-else class="spinner"></span>
              </button>
            </div>

            <!-- Acordeón de detalles -->
            <div class="product-accordion">
              <div class="accordion-item" v-for="(detail, index) in productDetails" :key="index">
                <button class="accordion-header" @click="toggleAccordion(index)">
                  {{ detail.title }}
                  <span class="accordion-icon">{{ accordionOpen[index] ? '−' : '+' }}</span>
                </button>
                <div class="accordion-content" v-if="accordionOpen[index]">
                  <p>{{ detail.content }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Lightbox para imágenes -->
    <div class="lightbox" v-if="lightboxOpen" @click="closeLightbox">
      <div class="lightbox-content" @click.stop>
        <button class="lightbox-close" @click="closeLightbox">&times;</button>
        <img :src="currentImage" :alt="product.name" class="lightbox-image">
      </div>
    </div>

    <!-- Notificación de producto añadido -->
    <transition name="slide-fade">
      <div class="cart-notification" v-if="showNotification">
        <div class="notification-content">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="notification-icon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <span>Producto añadido al carrito</span>
          <button class="view-cart-btn" @click="openCart">Ver carrito</button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import HeaderComponent from '@/shared/HeaderComponent.vue'

export default {
  name: 'ProductDetail',
  components: {
    HeaderComponent
  },
  data() {
    return {
      product: {
        id: 'palm-angels-shirt-001', // ID único del producto
        name: "Playera Palm Angels",
        price: 899,
        images: [
          "@/plantilla/images/palmR.jpg",
          "@/plantilla/images/palmR.jpg",
          "@/plantilla/images/palmR.jpg",
          "@/plantilla/images/palmR.jpg"
        ],
        colors: [
          { name: "Blanco", code: "#ffffff" },
          { name: "Negro", code: "#000000" },
          { name: "Gris", code: "#808080" }
        ],
        sizes: [
          { label: "XS", available: false },
          { label: "S", available: true },
          { label: "M", available: true },
          { label: "L", available: true },
          { label: "XL", available: true }
        ]
      },
      productDetails: [
        { title: "Descripción", content: "Playera de alta calidad con estampado Palm Angels. Corte regular, cuello redondo y mangas cortas." },
        { title: "Materiales", content: "100% Algodón orgánico. Tejido suave y transpirable." },
        { title: "Envíos y Devoluciones", content: "Envíos gratuitos en compras mayores a $1,500. Devoluciones dentro de los 30 días posteriores a la compra." }
      ],
      currentImage: "@/plantilla/images/palmR.jpg",
      selectedColor: null,
      selectedSize: null,
      quantity: 1,
      cartCount: 0,
      addingToCart: false,
      lightboxOpen: false,
      accordionOpen: [true, false, false],
      showNotification: false
    };
  },
  mounted() {
    this.loadCartFromLocalStorage();
  },
  methods: {
    changeImage(img) {
      this.currentImage = img;
    },
    selectColor(color) {
      this.selectedColor = color.name;
    },
    selectSize(size) {
      if (size.available) {
        this.selectedSize = size.label;
      }
    },
    incrementQuantity() {
      this.quantity++;
    },
    decrementQuantity() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },
    loadCartFromLocalStorage() {
      const cart = localStorage.getItem('cart');
      if (cart) {
        const parsedCart = JSON.parse(cart);
        this.cartCount = parsedCart.reduce((total, item) => total + item.quantity, 0);
      }
    },
    saveCartToLocalStorage(cart) {
      localStorage.setItem('cart', JSON.stringify(cart));
    },
    addToCart() {
      if (!this.selectedSize) return;
      
      this.addingToCart = true;
      
      // Obtener el carrito actual del localStorage
      const currentCart = JSON.parse(localStorage.getItem('cart')) || [];
      
      // Crear el nuevo item del carrito
      const newItem = {
        id: Date.now(), // ID único temporal
        productId: this.product.id,
        name: this.product.name,
        price: this.product.price,
        image: this.currentImage,
        color: this.selectedColor,
        size: this.selectedSize,
        quantity: this.quantity,
        addedAt: new Date().toISOString()
      };
      
      // Verificar si ya existe un producto similar en el carrito
      const existingItemIndex = currentCart.findIndex(item => 
        item.productId === newItem.productId && 
        item.color === newItem.color && 
        item.size === newItem.size
      );
      
      if (existingItemIndex >= 0) {
        // Si ya existe, actualizar la cantidad
        currentCart[existingItemIndex].quantity += newItem.quantity;
      } else {
        // Si no existe, añadir nuevo item
        currentCart.push(newItem);
      }
      
      // Guardar en localStorage
      this.saveCartToLocalStorage(currentCart);
      
      // Actualizar el contador
      this.cartCount = currentCart.reduce((total, item) => total + item.quantity, 0);
      
      this.addingToCart = false;
      this.showNotification = true;
      
      setTimeout(() => {
        this.showNotification = false;
      }, 3000);
    },
    openLightbox() {
      this.lightboxOpen = true;
    },
    closeLightbox() {
      this.lightboxOpen = false;
    },
    openSizeGuide() {
      console.log("Abrir guía de tallas");
    },
    toggleAccordion(index) {
      this.$set(this.accordionOpen, index, !this.accordionOpen[index]);
    },
    openCart() {
      // Emitir evento para abrir el carrito
      this.$emit('open-cart');
    }
  }
};
</script>

<style scoped>
/* Estilos generales */
body {
  font-family: 'Helvetica Neue', Arial, sans-serif;
  color: #333;
  line-height: 1.6;
}

/* Producto */
.product-container {
  max-width: 1200px;
  margin: 0 auto;
}

.badge {
  display: inline-block;
  background: #010c2a;
  color: white;
  padding: 0.25rem 0.75rem;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
  margin-bottom: 1rem;
}

.product-title {
  font-size: 2rem;
  font-weight: 300;
  margin-bottom: 1rem;
  letter-spacing: -0.5px;
}

.product-price {
  font-size: 1.5rem;
  font-weight: 500;
  margin-bottom: 1.5rem;
}

.divider {
  height: 1px;
  background: #eee;
  margin: 1.5rem 0;
}

/* Galería */
.product-gallery {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.main-image-container {
  cursor: zoom-in;
  overflow: hidden;
  border-radius: 4px;
}

.main-image {
  width: 100%;
  height: auto;
  transition: transform 0.3s ease;
}

.main-image:hover {
  transform: scale(1.02);
}

.thumbnail-container {
  display: flex;
  gap: 0.75rem;
}

.thumbnail {
  width: 70px;
  height: 70px;
  border: 1px solid #eee;
  border-radius: 4px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.3s ease;
}

.thumbnail:hover {
  border-color: #010c2a;
}

.thumbnail.active {
  border-color: #010c2a;
  position: relative;
}

.thumbnail.active::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 2px solid #010c2a;
}

/* Selectores */
.product-option {
  margin-bottom: 1.5rem;
}

.product-option h5 {
  font-size: 0.875rem;
  font-weight: 500;
  margin-bottom: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.color-selector {
  display: flex;
  gap: 0.75rem;
}

.color-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  border: 1px solid #eee;
  transition: all 0.3s ease;
}

.color-circle.selected {
  border-color: #010c2a;
  transform: scale(1.1);
}

.color-circle:hover .color-tooltip {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.color-tooltip {
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%) translateY(5px);
  background: #333;
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.75rem;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: all 0.2s ease;
  pointer-events: none;
}

.size-selector {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.size-btn {
  min-width: 40px;
  padding: 0.5rem;
  background: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.875rem;
}

.size-btn:hover {
  border-color: #010c2a;
}

.size-btn.selected {
  background: #010c2a;
  color: white;
  border-color: #010c2a;
}

.size-btn.disabled {
  color: #ccc;
  background: #f9f9f9;
  cursor: not-allowed;
  position: relative;
}

.size-btn.disabled::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: #ccc;
  transform: rotate(-45deg);
}

.size-guide {
  font-size: 0.75rem;
  color: #666;
  margin-top: 0.5rem;
  cursor: pointer;
  text-decoration: underline;
}

.size-guide:hover {
  color: #010c2a;
}

/* Acciones */
.product-actions {
  display: flex;
  gap: 1rem;
  margin: 2rem 0;
}

.quantity-selector {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 4px;
  overflow: hidden;
}

.quantity-btn {
  width: 40px;
  height: 40px;
  background: white;
  border: none;
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.quantity-btn:hover {
  background: #f5f5f5;
}

.quantity {
  width: 40px;
  text-align: center;
  font-weight: 500;
}

.add-to-cart-btn {
  flex: 1;
  padding: 0 1.5rem;
  background: #010c2a;
  color: white;
  border: none;
  border-radius: 4px;
  font-weight: 500;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s ease;
  height: 40px;
}

.add-to-cart-btn:hover {
  background: #000;
}

.add-to-cart-btn:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 50%;
  border-top-color: white;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Acordeón */
.product-accordion {
  border-top: 1px solid #eee;
}

.accordion-item {
  border-bottom: 1px solid #eee;
}

.accordion-header {
  width: 100%;
  padding: 1rem 0;
  background: none;
  border: none;
  text-align: left;
  font-size: 0.875rem;
  font-weight: 500;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.accordion-header:hover {
  color: #010c2a;
}

.accordion-icon {
  font-size: 1.25rem;
  font-weight: 300;
}

.accordion-content {
  padding-bottom: 1rem;
  font-size: 0.875rem;
  color: #666;
  line-height: 1.7;
}

/* Lightbox */
.lightbox {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  opacity: 0;
  animation: fadeIn 0.3s forwards;
}

@keyframes fadeIn {
  to { opacity: 1; }
}

.lightbox-content {
  position: relative;
  max-width: 90%;
  max-height: 90%;
}

.lightbox-close {
  position: absolute;
  top: -40px;
  right: 0;
  background: none;
  border: none;
  color: white;
  font-size: 2rem;
  cursor: pointer;
}

.lightbox-image {
  max-width: 100%;
  max-height: 80vh;
  object-fit: contain;
}

/* Notificación de carrito */
.cart-notification {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #010c2a;
  color: white;
  padding: 1rem 1.5rem;
  border-radius: 4px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  z-index: 1050;
  display: flex;
  align-items: center;
}

.notification-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.notification-icon {
  stroke: white;
}

.view-cart-btn {
  margin-left: 1rem;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.3);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  font-size: 0.75rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.view-cart-btn:hover {
  background: rgba(255,255,255,0.1);
}

/* Transiciones */
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .product-actions {
    flex-direction: column;
  }
  
  .add-to-cart-btn {
    width: 100%;
  }
  
  .cart-notification {
    bottom: 10px;
    right: 10px;
    left: 10px;
    justify-content: center;
  }
}
</style>