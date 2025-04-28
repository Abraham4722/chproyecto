<template>
    <div class="brand-products-container">
      <!-- Encabezado de la marca -->
      <div class="brand-header">
        <h1 class="brand-title">{{ currentBrand.name.toUpperCase() }}</h1>
        <div class="brand-meta">
          <span class="product-count">{{ filteredProducts.length }} PRODUCTOS</span>
          <div class="filter-controls">
            <button class="filter-btn" @click="toggleFilters">
              <i class="bi bi-funnel"></i> FILTRAR
            </button>
            <div class="sort-dropdown">
              <select v-model="sortOption" @change="sortProducts">
                <option value="price-asc">Precio: Menor a Mayor</option>
                <option value="price-desc">Precio: Mayor a Menor</option>
                <option value="newest">Más Nuevos</option>
              </select>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Banner de la marca -->
      <div class="brand-banner" v-if="currentBrand.banner_image">
        <img :src="currentBrand.banner_image" :alt="currentBrand.name" class="banner-img">
      </div>
  
      <!-- Grid de productos -->
      <div class="products-grid">
        <div v-for="product in filteredProducts" :key="product.id" class="product-card">
          <div class="product-badges">
            <span v-if="product.isNew" class="badge new">NUEVO</span>
            <span v-if="product.discount" class="badge discount">-{{ product.discount }}%</span>
          </div>
          
          <img :src="product.image || placeholderImage" :alt="product.name" class="product-image">
          
          <div class="product-info">
            <h3 class="product-name">{{ product.name }}</h3>
            <div class="product-category">{{ product.category }}</div>
            
            <div class="price-section">
              <span class="current-price">${{ formatPrice(product.price) }}</span>
              <span v-if="product.originalPrice" class="original-price">${{ formatPrice(product.originalPrice) }}</span>
            </div>
            
            <div class="color-options" v-if="product.availableColors && product.availableColors.length">
              <span 
                v-for="(color, index) in product.availableColors.slice(0, 3)" 
                :key="index"
                class="color-swatch"
                :style="{ backgroundColor: color.code }"
                :title="color.name"
              ></span>
              <span v-if="product.availableColors.length > 3" class="more-colors">+{{ product.availableColors.length - 3 }} más</span>
            </div>
            
            <div class="size-options" v-if="product.availableSizes && product.availableSizes.length">
              <span 
                v-for="(size, index) in product.availableSizes" 
                :key="index"
                class="size-pill"
                :class="{ 'out-of-stock': !size.inStock }"
              >
                {{ size.label }}
              </span>
            </div>
            
            <button class="add-to-cart-btn" @click="addToCart(product)">
              AÑADIR AL CARRITO
            </button>
          </div>
        </div>
      </div>
  
      <!-- Cargando -->
      <div v-if="loading" class="loading-overlay">
        <div class="spinner"></div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'BrandProducts',
    props: {
      brandId: {
        type: [String, Number],
        required: true
      }
    },
    data() {
      return {
        currentBrand: {
          name: '',
          description: '',
          banner_image: ''
        },
        products: [],
        sortOption: 'newest',
        loading: false,
        placeholderImage: 'https://via.placeholder.com/300x400?text=Imagen+no+disponible',
        filters: {
          category: [],
          color: [],
          size: [],
          priceRange: [0, 5000]
        },
        activeFilters: []
      }
    },
    computed: {
      filteredProducts() {
        let filtered = [...this.products];
        
        // Aplicar filtros
        if (this.filters.category.length > 0) {
          filtered = filtered.filter(p => this.filters.category.includes(p.category));
        }
        
        // Filtrar por rango de precio
        filtered = filtered.filter(p => {
          return p.price >= this.filters.priceRange[0] && p.price <= this.filters.priceRange[1];
        });
        
        // Ordenar
        if (this.sortOption === 'price-asc') {
          filtered.sort((a, b) => a.price - b.price);
        } else if (this.sortOption === 'price-desc') {
          filtered.sort((a, b) => b.price - a.price);
        } else {
          filtered.sort((a, b) => (b.isNew ? 1 : 0) - (a.isNew ? 1 : 0) || b.id - a.id);
        }
        
        return filtered;
      }
    },
    async created() {
      await this.loadBrandData();
      await this.loadProducts();
    },
    methods: {
      async loadBrandData() {
        this.loading = true;
        try {
          const response = await axios.get(`/api/marcas/${this.brandId}`);
          this.currentBrand = response.data;
        } catch (error) {
          console.error("Error cargando marca:", error);
          this.currentBrand = {
            name: 'Marca no encontrada',
            description: '',
            banner_image: ''
          };
        } finally {
          this.loading = false;
        }
      },
      async loadProducts() {
        this.loading = true;
        try {
          const response = await axios.get(`/api/marcas/${this.brandId}/productos`);
          this.products = response.data.map(product => ({
            ...product,
            isNew: product.created_at > new Date(Date.now() - 30 * 24 * 60 * 60 * 1000).toISOString()
          }));
        } catch (error) {
          console.error("Error cargando productos:", error);
          this.products = [];
        } finally {
          this.loading = false;
        }
      },
      formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      },
      toggleFilters() {
        // Implementar lógica para mostrar/ocultar panel de filtros
        console.log("Mostrar/ocultar filtros");
      },
      addToCart(product) {
        console.log("Añadir al carrito:", product);
        // Implementar lógica para añadir al carrito
      },
      sortProducts() {
        // La ordenación se maneja en el computed property
      },
      removeFilter(filter) {
        console.log("Eliminar filtro:", filter);
        // Implementar lógica para eliminar filtros
      }
    }
  }
  </script>
  
  <style scoped>
  .brand-products-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    position: relative;
  }
  
  .brand-header {
    margin-bottom: 30px;
  }
  
  .brand-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 10px;
    text-align: center;
  }
  
  .brand-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .product-count {
    font-size: 0.9rem;
    color: #666;
  }
  
  .filter-controls {
    display: flex;
    gap: 15px;
  }
  
  .filter-btn, .sort-dropdown select {
    padding: 8px 15px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    font-size: 0.9rem;
  }
  
  .brand-banner {
    width: 100%;
    height: 400px;
    overflow: hidden;
    margin-bottom: 40px;
    border-radius: 8px;
  }
  
  .banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
  }
  
  .product-card {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    background: white;
  }
  
  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  
  .product-badges {
    position: absolute;
    top: 10px;
    left: 10px;
    display: flex;
    gap: 5px;
    z-index: 2;
  }
  
  .badge {
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 0.7rem;
    font-weight: bold;
    color: white;
  }
  
  .badge.new {
    background: #000;
  }
  
  .badge.discount {
    background: #e63946;
  }
  
  .product-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
  }
  
  .product-info {
    padding: 15px;
  }
  
  .product-name {
    font-size: 1.1rem;
    margin: 0 0 10px;
    font-weight: 600;
    min-height: 50px;
  }
  
  .product-category {
    font-size: 0.9rem;
    color: #888;
    margin-bottom: 15px;
  }
  
  .price-section {
    margin-bottom: 15px;
  }
  
  .current-price {
    font-size: 1.2rem;
    font-weight: bold;
    margin-right: 10px;
  }
  
  .original-price {
    font-size: 0.9rem;
    text-decoration: line-through;
    color: #999;
  }
  
  .color-options {
    display: flex;
    gap: 8px;
    margin-bottom: 15px;
    align-items: center;
  }
  
  .color-swatch {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #ddd;
    cursor: pointer;
  }
  
  .more-colors {
    font-size: 0.8rem;
    color: #666;
  }
  
  .size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
  }
  
  .size-pill {
    padding: 3px 10px;
    border: 1px solid #ddd;
    border-radius: 15px;
    font-size: 0.8rem;
  }
  
  .size-pill.out-of-stock {
    color: #ccc;
    border-color: #eee;
    position: relative;
  }
  
  .size-pill.out-of-stock::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #ccc;
  }
  
  .add-to-cart-btn {
    width: 100%;
    padding: 10px;
    background: #000;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
  }
  
  .add-to-cart-btn:hover {
    background: #333;
  }
  
  .loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  
  .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  @media (max-width: 768px) {
    .brand-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
    }
    
    .brand-meta {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
    }
    
    .products-grid {
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    }
    
    .product-image {
      height: 250px;
    }
    
    .brand-title {
      font-size: 1.8rem;
      text-align: left;
    }
  }
  </style>