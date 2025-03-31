<template>
  <HeadreComponent/>

  <!-- Carrusel principal más compacto -->
  <div id="mainCarousel" class="carousel slide carousel-compact" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="@/plantilla/images/palmR.jpg" class="d-block w-100" alt="Colección Verano 2023">
        <div class="carousel-caption d-none d-md-block">
          <h5>Colección Verano 2023</h5>
          <p>Nuevos estilos para esta temporada</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="@/plantilla/images/palmR.jpg" class="d-block w-100" alt="Ofertas Especiales">
        <div class="carousel-caption d-none d-md-block">
          <h5>Ofertas Especiales</h5>
          <p>Hasta 40% de descuento en selección de productos</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="@/plantilla/images/palmR.jpg" class="d-block w-100" alt="Nuevos Ingresos">
        <div class="carousel-caption d-none d-md-block">
          <h5>Nuevos Ingresos</h5>
          <p>Descubre las últimas tendencias</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Sección de categorías -->
  <section class="categories py-4">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-4">
          <div class="category-card">
            <img src="@/plantilla/images/palmR.jpg" alt="Mujeres" class="img-fluid">
            <div class="category-overlay">
              <h3 style="color: aliceblue;">BOOS</h3>
              <a href="#" class="btn btn-outline-light">Ver colección</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="category-card">
            <img src="@/plantilla/images/palmR.jpg" alt="Hombres" class="img-fluid">
            <div class="category-overlay">
              <h3 style="color: aliceblue;">HUGO</h3>
              <a href="#" class="btn btn-outline-light">Ver colección</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="category-card">
            <img src="@/plantilla/images/palmR.jpg" alt="Niños" class="img-fluid">
            <div class="category-overlay">
              <h3 style="color: aliceblue;">PALM ANGELS</h3>
              <a href="#" class="btn btn-outline-light">Ver colección</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Productos destacados -->
  <section class="featured-products py-5 bg-light">
    <div class="container">
      <h2 class="section-title text-center mb-5">Productos Destacados</h2>
      <div class="row g-4">
        <div class="col-md-3 col-6" v-for="(product, index) in featuredProducts" :key="index">
          <div class="product-card">
            <div class="product-badge" v-if="product.discount">-{{ product.discount }}%</div>
            <div class="product-thumb">
              <a href="#">
                <img :src="url+'productos/' + product.imagen" class="img-fluid" :alt="product.nombre">
              </a>
            </div>
            <div class="product-details">
              <h4><a href="#">{{ product.nombre }}</a></h4>
              <div class="product-price">
                <span class="price" :class="{'old-price': product.oldPrice}">${{ product.precio }}</span>
                <span class="old-price" v-if="product.oldPrice">${{ product.oldPrice }}</span>
              </div>
              <div class="product-links">
                <a href="#" class="btn btn-sm btn-outline-secondary">Añadir al carrito</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-4">
        <a href="#" class="btn btn-dark">Ver todos los productos</a>
      </div>
    </div>
  </section>

  <!-- Carrusel de marcas -->
  <section class="brands py-4">
    <div class="container">
      <h3 class="section-subtitle text-center mb-4">Marcas que nos respaldan</h3>
      <div class="brand-slider">
        <div class="brand-item">
          <img src="@/plantilla/images/palmR.jpg" alt="Marca 1" class="img-fluid">
        </div>
        <div class="brand-item">
          <img src="@/plantilla/images/palmR.jpg" alt="Marca 2" class="img-fluid">
        </div>
        <div class="brand-item">
          <img src="@/plantilla/images/palmR.jpg" alt="Marca 3" class="img-fluid">
        </div>
        <div class="brand-item">
          <img src="@/plantilla/images/palmR.jpg" alt="Marca 4" class="img-fluid">
        </div>
        <div class="brand-item">
          <img src="@/plantilla/images/palmR.jpg" alt="Marca 5" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <!-- Ofertas especiales -->
  <section class="special-offers py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="@/plantilla/images/palmR.jpg" alt="Oferta Especial" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
          <h2 class="offer-title">Oferta Especial de Verano</h2>
          <p class="offer-description">Hasta 50% de descuento en selección de productos de verano. No dejes pasar esta oportunidad y renueva tu guardarropa con nuestras últimas tendencias.</p>
          <div class="countdown mb-4">
            <h5>La oferta termina en:</h5>
            <div class="countdown-timer">
              <span class="days">05</span>d :
              <span class="hours">12</span>h :
              <span class="minutes">45</span>m :
              <span class="seconds">30</span>s
            </div>
          </div>
          <a href="#" class="btn btn-danger">Comprar ahora</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonios -->
  <section class="testimonials py-5 bg-light">
    <div class="container">
      <h2 class="section-title text-center mb-5">Lo que dicen nuestros clientes</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="testimonial-card">
            <div class="rating mb-3">
              ★ ★ ★ ★ ★
            </div>
            <p class="testimonial-text">"La calidad de la ropa superó mis expectativas. Definitivamente volveré a comprar aquí."</p>
            <div class="testimonial-author">
              <img src="@/plantilla/images/palmR.jpg" alt="Cliente 1" class="rounded-circle">
              <h5>María González</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card">
            <div class="rating mb-3">
              ★ ★ ★ ★ ☆
            </div>
            <p class="testimonial-text">"Excelente servicio al cliente y envío rápido. Los productos son exactamente como en las fotos."</p>
            <div class="testimonial-author">
              <img src="@/plantilla/images/palmR.jpg" alt="Cliente 2" class="rounded-circle">
              <h5>Carlos Martínez</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card">
            <div class="rating mb-3">
              ★ ★ ★ ★ ★
            </div>
            <p class="testimonial-text">"Me encanta la variedad de estilos que ofrecen. Siempre encuentro algo que se adapta a mi gusto."</p>
            <div class="testimonial-author">
              <img src="@/plantilla/images/palmR.jpg" alt="Cliente 3" class="rounded-circle">
              <h5>Ana López</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="newsletter py-5 bg-dark text-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h3>Suscríbete a nuestro boletín</h3>
          <p class="mb-4">Recibe las últimas novedades, ofertas exclusivas y descuentos especiales directamente en tu correo.</p>
          <form class="newsletter-form">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Tu correo electrónico" required>
              <button class="btn btn-primary" type="submit">Suscribirse</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <FooterComponent/>
</template>

<script>
import HeadreComponent from '@/shared/HeaderComponent.vue'
import FooterComponent from '@/shared/FooterComponent.vue';
import axios from 'axios';
export default {
  name: 'HomeComponent',
  components: {
    HeadreComponent,
    FooterComponent
  },
  data() {
    return {
      featuredProducts: [
        {
          name: 'Camiseta básica blanca',
          price: 24.99,
          oldPrice: 34.99,
          discount: 30,
          image: '@/plantilla/images/product-1.jpg'
        },
        {
          name: 'Jeans slim fit',
          price: 49.99,
          image: '@/plantilla/images/product-2.jpg'
        },
        {
          name: 'Vestido floral',
          price: 39.99,
          oldPrice: 59.99,
          discount: 33,
          image: '@/plantilla/images/product-3.jpg'
        },
        {
          name: 'Chaqueta denim',
          price: 79.99,
          image: '@/plantilla/images/product-4.jpg'
        },
        {
          name: 'Zapatos casuales',
          price: 59.99,
          oldPrice: 79.99,
          discount: 25,
          image: '@/plantilla/images/product-5.jpg'
        },
        {
          name: 'Bolso de mano',
          price: 45.99,
          image: '@/plantilla/images/product-6.jpg'
        },
        {
          name: 'Gorra ajustable',
          price: 19.99,
          image: '@/plantilla/images/product-7.jpg'
        },
        {
          name: 'Bufanda de lana',
          price: 29.99,
          oldPrice: 39.99,
          discount: 25,
          image: '@/plantilla/images/product-8.jpg'
        }
      ],    
      ultimos:[],
      categorias:[], 
      loaded:false,
      url:'http://localhost:8000/'

    }
  },
  mounted(){
    this.refresh()
  },
  methods:{
      refresh(){
       
        axios.get('index').then((Response)=>{
          console.log("RESPUESTA DESDE EL BAKEND", Response.data)

          this.featuredProducts=Response.data.ultimos

        }).catch((error)=>{
          console.log("ERROR",error)
        }).finally(()=>{
          this.loaded=true
        })
       
      }

    },
}
</script>

<style scoped>
/* Estilos para el carrusel compacto */
.carousel-compact {
  max-height: 400px;
  overflow: hidden;
}

.carousel-compact .carousel-item img {
  object-fit: cover;
  height: 400px;
}

.carousel-caption {
  background-color: rgba(0, 0, 0, 0.6);
  padding: 15px;
  border-radius: 5px;
}

/* Estilos para las categorías */
.category-card {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.category-card:hover {
  transform: translateY(-5px);
}

.category-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.6);
  color: white;
  padding: 15px;
  text-align: center;
}

/* Estilos para las tarjetas de producto */
.product-card {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  height: 100%;
}

.product-card:hover {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
}

.product-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  background: #dc3545;
  color: white;
  padding: 3px 8px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: bold;
  z-index: 1;
}

.product-thumb {
  height: 200px;
  overflow: hidden;
}

.product-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card:hover .product-thumb img {
  transform: scale(1.05);
}

.product-details {
  padding: 15px;
}

.product-price {
  margin: 10px 0;
}

.price {
  font-weight: bold;
  font-size: 18px;
  color: #333;
}

.old-price {
  text-decoration: line-through;
  color: #999;
  font-size: 14px;
  margin-left: 8px;
}

/* Estilos para el slider de marcas */
.brand-slider {
  display: flex;
  overflow-x: auto;
  padding: 20px 0;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}

.brand-item {
  flex: 0 0 auto;
  margin: 0 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 150px;
}

.brand-item img {
  max-width: 100%;
  height: auto;
  filter: grayscale(100%);
  opacity: 0.7;
  transition: all 0.3s ease;
}

.brand-item:hover img {
  filter: grayscale(0%);
  opacity: 1;
}

/* Estilos para ofertas especiales */
.special-offers {
  background-color: #f8f9fa;
}

.offer-title {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #333;
}

.offer-description {
  margin-bottom: 1.5rem;
  color: #666;
}

.countdown-timer {
  font-size: 1.5rem;
  font-weight: bold;
  color: #dc3545;
}

/* Estilos para testimonios */
.testimonial-card {
  background: white;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  height: 100%;
}

.rating {
  color: #ffc107;
  font-size: 1.2rem;
}

.testimonial-text {
  font-style: italic;
  margin-bottom: 20px;
}

.testimonial-author {
  display: flex;
  align-items: center;
}

.testimonial-author img {
  width: 50px;
  height: 50px;
  margin-right: 15px;
}

/* Estilos responsive */
@media (max-width: 768px) {
  .carousel-compact .carousel-item img {
    height: 300px;
  }
  
  .product-thumb {
    height: 150px;
  }
  
  .brand-item {
    width: 120px;
  }
}
</style>