<template>
    <div>
      <!-- Navbar (manteniendo tu estructura) -->
      <nav class="navbar navbar-expand-lg text-uppercase fs-6 p-3 border-bottom align-items-center" style="background-color:#010c2a;">
        <div class="container-fluid">
          <div class="row justify-content-between align-items-center w-100">
            <div class="col-auto">
              <a class="navbar-brand text-white" href="index.html">
                <img src="@/plantilla/images/logo.jpg" alt="" style="width: 50px; height: 50px;">
              </a>
            </div>
            <!-- Resto de tu navbar... -->
          </div>
        </div>
      </nav>
  
      <!-- Checkout Container -->
      <div class="checkout-container container py-5">
        <div class="row">
          <!-- Paso 1: Información de envío -->
          <div class="col-lg-7" v-if="currentStep === 1">
            <div class="checkout-card">
              <h2 class="checkout-title mb-4">Información de envío</h2>
              
              <form @submit.prevent="nextStep">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="firstName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="firstName" v-model="shipping.firstName" required>
                  </div>
                  <div class="col-md-6">
                    <label for="lastName" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="lastName" v-model="shipping.lastName" required>
                  </div>
                  <div class="col-12">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" v-model="shipping.address" required>
                  </div>
                  <div class="col-md-4">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="city" v-model="shipping.city" required>
                  </div>
                  <div class="col-md-4">
                    <label for="state" class="form-label">Estado</label>
                    <select class="form-select" id="state" v-model="shipping.state" required>
                      <option value="" disabled selected>Seleccionar...</option>
                      <option v-for="state in states" :value="state" :key="state">{{ state }}</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="zip" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="zip" v-model="shipping.zip" required>
                  </div>
                  <div class="col-12">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="phone" v-model="shipping.phone" required>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" v-model="shipping.email" required>
                  </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-outline-dark" @click="$router.back()">Regresar</button>
                  <button type="submit" class="btn btn-dark">Continuar</button>
                </div>
              </form>
            </div>
          </div>
  
          <!-- Paso 2: Método de pago -->
          <div class="col-lg-7" v-if="currentStep === 2">
            <div class="checkout-card">
              <h2 class="checkout-title mb-4">Método de pago</h2>
              
              <div class="payment-methods">
                <div class="payment-method" 
                     v-for="method in paymentMethods" 
                     :key="method.id"
                     @click="selectPaymentMethod(method.id)"
                     :class="{ 'active': payment.method === method.id }">
                  <div class="method-icon">
                    <i :class="method.icon"></i>
                  </div>
                  <div class="method-info">
                    <h5>{{ method.name }}</h5>
                    <small>{{ method.description }}</small>
                  </div>
                </div>
              </div>
  
              <!-- Formulario de tarjeta (solo si se selecciona tarjeta) -->
              <div class="credit-card-form mt-4" v-if="payment.method === 'creditCard'">
                <div class="row g-3">
                  <div class="col-12">
                    <label for="cardNumber" class="form-label">Número de tarjeta</label>
                    <input type="text" class="form-control" id="cardNumber" 
                           v-model="payment.cardNumber" 
                           @input="formatCardNumber"
                           placeholder="1234 5678 9012 3456">
                  </div>
                  <div class="col-md-6">
                    <label for="cardName" class="form-label">Nombre en la tarjeta</label>
                    <input type="text" class="form-control" id="cardName" v-model="payment.cardName">
                  </div>
                  <div class="col-md-3">
                    <label for="expiry" class="form-label">Expiración</label>
                    <input type="text" class="form-control" id="expiry" 
                           v-model="payment.expiry" 
                           @input="formatExpiry"
                           placeholder="MM/AA">
                  </div>
                  <div class="col-md-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" 
                           v-model="payment.cvv" 
                           maxlength="3"
                           placeholder="123">
                  </div>
                </div>
              </div>
  
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-dark" @click="prevStep">Atrás</button>
                <button type="button" class="btn btn-dark" @click="nextStep">Continuar</button>
              </div>
            </div>
          </div>
  
          <!-- Paso 3: Revisar y confirmar -->
          <div class="col-lg-7" v-if="currentStep === 3">
            <div class="checkout-card">
              <h2 class="checkout-title mb-4">Revisar pedido</h2>
              
              <div class="order-summary">
                <div class="shipping-info mb-4">
                  <h5>Información de envío</h5>
                  <p>{{ shipping.firstName }} {{ shipping.lastName }}</p>
                  <p>{{ shipping.address }}</p>
                  <p>{{ shipping.city }}, {{ shipping.state }} {{ shipping.zip }}</p>
                  <p>Tel: {{ shipping.phone }}</p>
                  <p>Email: {{ shipping.email }}</p>
                </div>
                
                <div class="payment-info mb-4">
                  <h5>Método de pago</h5>
                  <div v-if="payment.method === 'creditCard'">
                    <p>Tarjeta de crédito terminada en {{ payment.cardNumber.slice(-4) }}</p>
                  </div>
                  <div v-else>
                    <p>{{ getPaymentMethodName(payment.method) }}</p>
                  </div>
                </div>
                
                <div class="products-list">
                  <h5>Tu pedido</h5>
                  <div class="product-item" v-for="item in cart" :key="item.id">
                    <div class="product-image">
                      <img :src="item.image" :alt="item.name">
                    </div>
                    <div class="product-details">
                      <h6>{{ item.name }}</h6>
                      <small>Talla: {{ item.size }}</small>
                      <small>Cantidad: {{ item.quantity }}</small>
                    </div>
                    <div class="product-price">
                      ${{ (item.price * item.quantity).toFixed(2) }}
                    </div>
                  </div>
                </div>
                
                <div class="order-totals mt-4">
                  <div class="total-row">
                    <span>Subtotal</span>
                    <span>${{ subtotal.toFixed(2) }}</span>
                  </div>
                  <div class="total-row">
                    <span>Envío</span>
                    <span>${{ shippingCost.toFixed(2) }}</span>
                  </div>
                  <div class="total-row grand-total">
                    <span>Total</span>
                    <span>${{ (subtotal + shippingCost).toFixed(2) }}</span>
                  </div>
                </div>
              </div>
  
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-dark" @click="prevStep">Atrás</button>
                <button type="button" class="btn btn-dark" @click="placeOrder">Confirmar pedido</button>
                <div id="btnPayPal"></div>
              </div>
            </div>
          </div>
  
          <!-- Resumen del pedido (lado derecho) -->
          <div class="col-lg-5">
            <div class="order-summary-card">
              <h3 class="summary-title mb-4">Resumen del pedido</h3>
              
              <div class="products-summary">
                <div class="product-summary" v-for="item in cart" :key="item.id">
                  <div class="product-image">
                    <img :src="item.image" :alt="item.name">
                    <span class="quantity-badge">{{ item.quantity }}</span>
                  </div>
                  <div class="product-info">
                    <h6>{{ item.name }}</h6>
                    <small>Talla: {{ item.size }}</small>
                  </div>
                  <div class="product-price">
                    ${{ (item.price * item.quantity).toFixed(2) }}
                  </div>
                </div>
              </div>
              
              <div class="summary-totals mt-3">
                <div class="summary-row">
                  <span>Subtotal</span>
                  <span>${{ subtotal.toFixed(2) }}</span>
                </div>
                <div class="summary-row">
                  <span>Envío</span>
                  <span>${{ shippingCost.toFixed(2) }}</span>
                </div>
                <div class="summary-row grand-total">
                  <span>Total</span>
                  <span>${{ (subtotal + shippingCost).toFixed(2) }}</span>
                </div>
              </div>
              
              <div class="promo-code mt-4">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Código promocional" v-model="promoCode">
                  <button class="btn btn-outline-dark" type="button" @click="applyPromo">Aplicar</button>
                </div>
                <small class="text-success" v-if="promoApplied">¡Código aplicado con éxito!</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </template>
  
  <script>
  import { loadScript } from '@paypal/paypal-js';   

  export default {
    name: 'CheckoutComponent',      
    components: {},
    mounted() {
      
    },

    data() {
      return {
        currentStep: 1,
        states: ['CDMX', 'Jalisco', 'Nuevo León', 'Puebla', 'Veracruz', 'Yucatán'],
        shipping: {
          firstName: '',
          lastName: '',
          address: '',
          city: '',
          state: '',
          zip: '',
          phone: '',
          email: ''
        },
        payment: {
          method: '',
          cardNumber: '',
          cardName: '',
          expiry: '',
          cvv: ''
        },
        paymentMethods: [
          {
            id: 'creditCard',
            name: 'Tarjeta de crédito/débito',
            description: 'Paga con Visa, Mastercard o American Express',
            icon: 'bi bi-credit-card'
          },
          {
            id: 'paypal',
            name: 'PayPal',
            description: 'Paga con tu cuenta PayPal',
            icon: 'bi bi-paypal'
          },
          {
            id: 'transfer',
            name: 'Transferencia bancaria',
            description: 'Paga mediante transferencia',
            icon: 'bi bi-bank'
          }
        ],
        cart: [
          {
            id: 1,
            name: 'Playera Palm Angels',
            price: 899,
            size: 'M',
            quantity: 1,
            image: '@/plantilla/images/palmR.jpg'
          },
          {
            id: 2,
            name: 'Pantalón Jeans',
            price: 1200,
            size: '32',
            quantity: 1,
            image: '@/plantilla/images/jeans.jpg'
          }
        ],
        promoCode: '',
        promoApplied: false,
        shippingCost: 99
      }
    },
    computed: {
      subtotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      }
    },
    methods: {
      pagar(){
        loadScript({
          'clientId':'AXB7PeqyBR4kBmXx1xh096fTRnFh4fKzUJXYSQ1zIWciiAeliCEvjEKPQnr7vBLnZZ6nu8vNtXFh99tF',
          'currency':'MXN',

        }).then((paypal)=>{
          paypal.Buttons({
            createOrder:this.createOrder,
            onApprove:this.onApprove,
          }).render('#btnPayPal');

        })
      },
      createOrder(data,actions){
        console.log("CREANDO ORDER",data,actions);
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '299.98'
            },
          }],
        }).then((orderId)=>{
          console.log("ORDER ID",orderId);
          return orderId;
        });
      },
      onApprove(data,actions){
        console.log("APROVANDO",data,actions);
        alert("Pago realizado con éxito");
        return actions.order.capture().then((details)=>{
          console.log("Detalles de la orden",details);
          alert('Gracias por tu compra' + details.payer.name.given_name);
        });
      
      },
      nextStep() {
        if (this.validateStep()) {
          this.currentStep++;
          if (this.currentStep === 2 && this.payment.method === 'paypal') {
            this.pagar();
          }
        }
      },
      prevStep() {
        this.currentStep--;
      },
      validateStep() {
        if (this.currentStep === 1) {
          // Validar información de envío
          if (!this.shipping.firstName || !this.shipping.lastName || !this.shipping.address || 
              !this.shipping.city || !this.shipping.state || !this.shipping.zip || 
              !this.shipping.phone || !this.shipping.email) {
            alert('Por favor completa todos los campos de envío');
            return false;
          }
        } else if (this.currentStep === 2) {
          // Validar método de pago
          if (!this.payment.method) {
            alert('Por favor selecciona un método de pago');
            return false;
          }
          if (this.payment.method === 'creditCard') {
            if (!this.payment.cardNumber || !this.payment.cardName || !this.payment.expiry || !this.payment.cvv) {
              alert('Por favor completa toda la información de la tarjeta');
              return false;
            }
          }
        }
        return true;
      },
      selectPaymentMethod(method) {
        this.payment.method = method;
      },
      formatCardNumber() {
        this.payment.cardNumber = this.payment.cardNumber
          .replace(/\D/g, '')
          .replace(/(\d{4})(?=\d)/g, '$1 ');
      },
      formatExpiry() {
        this.payment.expiry = this.payment.expiry
          .replace(/\D/g, '')
          .replace(/(\d{2})(?=\d)/g, '$1/');
      },
      getPaymentMethodName(methodId) {
        const method = this.paymentMethods.find(m => m.id === methodId);
        return method ? method.name : '';
      },
      applyPromo() {
        if (this.promoCode === 'DESCUENTO20') {
          this.shippingCost = 0;
          this.promoApplied = true;
        } else {
          alert('Código promocional no válido');
        }
      },
      placeOrder() {
        this.pagar()
        // Aquí iría la lógica para procesar el pedido
        //alert('Pedido confirmado. ¡Gracias por tu compra!');
        // Redirigir a página de confirmación
        //this.$router.push('/order-confirmation');
      }
    }
  }
  </script>
  
  <style scoped>
  .checkout-container {
    max-width: 1400px;
    margin: 0 auto;
  }
  
  .checkout-card, .order-summary-card {
    background: #fff;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
  }
  
  .checkout-title, .summary-title {
    font-weight: 600;
    color: #010c2a;
    border-bottom: 1px solid #eee;
    padding-bottom: 1rem;
  }
  
  .form-control, .form-select {
    padding: 0.75rem;
    border-radius: 4px;
    border: 1px solid #ddd;
  }
  
  .form-control:focus, .form-select:focus {
    border-color: #010c2a;
    box-shadow: 0 0 0 0.25rem rgba(1, 12, 42, 0.25);
  }
  
  .payment-methods {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .payment-method {
    display: flex;
    align-items: center;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .payment-method:hover, .payment-method.active {
    border-color: #010c2a;
    background-color: rgba(1, 12, 42, 0.05);
  }
  
  .method-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
    color: #010c2a;
  }
  
  .method-info h5 {
    margin-bottom: 0.25rem;
    font-size: 1rem;
  }
  
  .method-info small {
    color: #666;
  }
  
  .products-summary {
    max-height: 400px;
    overflow-y: auto;
  }
  
  .product-summary {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #eee;
  }
  
  .product-image {
    position: relative;
    width: 70px;
    height: 70px;
    margin-right: 1rem;
  }
  
  .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  .quantity-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #010c2a;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
  }
  
  .product-info {
    flex: 1;
  }
  
  .product-info h6 {
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
  }
  
  .product-info small {
    display: block;
    color: #666;
    font-size: 0.8rem;
  }
  
  .product-price {
    font-weight: 600;
    color: #010c2a;
  }
  
  .summary-row, .total-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
  }
  
  .grand-total {
    font-weight: 600;
    font-size: 1.1rem;
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #eee;
  }
  
  .products-list {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 1rem 0;
    margin: 1rem 0;
  }
  
  .product-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
  }
  
  .btn-dark {
    background-color: #010c2a;
    border-color: #010c2a;
  }
  
  .btn-dark:hover {
    background-color: #020f38;
    border-color: #020f38;
  }
  
  @media (max-width: 992px) {
    .order-summary-card {
      margin-top: 2rem;
    }
  }
  </style>