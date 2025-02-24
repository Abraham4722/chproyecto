<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda | Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('dashboard/css/adminlte.css') }}">
</head>

<body class="layout-fixed sidebar-expand-lg bg-light">
  <div class="app-wrapper">
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

    <main class="app-main">
      <div class="container-fluid py-4">
        <!-- Carrusel de productos -->
        <div id="carouselProducts" class="carousel slide mb-4 shadow rounded" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/images/product1.jpg" class="d-block w-100 rounded" alt="Producto 1">
            </div>
            <div class="carousel-item">
              <img src="/images/product2.jpg" class="d-block w-100 rounded" alt="Producto 2">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>

        <!-- Sección de métricas -->
        <div class="row">
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-currency-dollar display-4 text-primary me-3"></i>
                <div>
                  <h6 class="text-muted mb-1">Ventas Hoy</h6>
                  <h3 class="fw-bold text-dark">$1,250</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-cart-check display-4 text-success me-3"></i>
                <div>
                  <h6 class="text-muted mb-1">Pedidos</h6>
                  <h3 class="fw-bold text-dark">34</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabla de pedidos recientes -->
        <div class="card mt-4 shadow-sm border-0 rounded">
          <div class="card-header bg-primary text-white">Últimos Pedidos</div>
          <div class="card-body">
            <table class="table table-hover">
              <thead class="table-light">
                <tr>
                  <th><i class="bi bi-hash"></i> ID</th>
                  <th><i class="bi bi-person"></i> Cliente</th>
                  <th><i class="bi bi-currency-dollar"></i> Total</th>
                  <th><i class="bi bi-truck"></i> Estado</th>
                  <th><i class="bi bi-eye"></i> Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#1234</td>
                  <td>Juan Pérez</td>
                  <td>$150.00</td>
                  <td><span class="badge bg-success">Enviado</span></td>
                  <td><button class="btn btn-info btn-sm ver-pedido" data-id="1234" data-cliente="Juan Pérez" data-total="$150.00" data-estado="Enviado" data-productos="Camiseta Negra - $50.00, Gorra Roja - $30.00, Sudadera Azul - $70.00"><i class="bi bi-eye"></i> Ver</button></td>
                </tr>
                <tr>
                  <td>#1235</td>
                  <td>María López</td>
                  <td>$200.00</td>
                  <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                  <td><button class="btn btn-info btn-sm ver-pedido" data-id="1235" data-cliente="María López" data-total="$200.00" data-estado="Pendiente" data-productos="Camiseta Blanca - $100.00, Jeans - $100.00"><i class="bi bi-eye"></i> Ver</button></td>
                </tr>
                <tr>
                  <td>#1236</td>
                  <td>Carlos Ramírez</td>
                  <td>$320.00</td>
                  <td><span class="badge bg-danger">Cancelado</span></td>
                  <td><button class="btn btn-info btn-sm ver-pedido" data-id="1236" data-cliente="Carlos Ramírez" data-total="$320.00" data-estado="Cancelado" data-productos="Sudadera Negra - $120.00, Tenis Deportivos - $200.00"><i class="bi bi-eye"></i> Ver</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal de detalles del pedido -->
        <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="pedidoModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="pedidoModalLabel">Detalles del Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><strong>ID:</strong> <span id="modal-id"></span></p>
                <p><strong>Cliente:</strong> <span id="modal-cliente"></span></p>
                <p><strong>Total:</strong> <span id="modal-total"></span></p>
                <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
                <p><strong>Productos:</strong></p>
                <ul id="modal-productos"></ul>
              </div>
            </div>
          </div>
        </div>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            const botonesVer = document.querySelectorAll(".ver-pedido");

            botonesVer.forEach(boton => {
              boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const cliente = this.getAttribute("data-cliente");
                const total = this.getAttribute("data-total");
                const estado = this.getAttribute("data-estado");
                const productos = this.getAttribute("data-productos").split(", ");

                document.getElementById("modal-id").innerText = id;
                document.getElementById("modal-cliente").innerText = cliente;
                document.getElementById("modal-total").innerText = total;
                document.getElementById("modal-estado").innerText = estado;

                const productosList = document.getElementById("modal-productos");
                productosList.innerHTML = "";
                productos.forEach(producto => {
                  const li = document.createElement("li");
                  li.textContent = producto;
                  productosList.appendChild(li);
                });

                new bootstrap.Modal(document.getElementById("pedidoModal")).show();
              });
            });
          });
        </script>


    </main>

    <footer class="app-footer text-center py-3 bg-dark text-white mt-4">
      <strong>&copy; 2024 Ch-Shirt | Todos los derechos reservados</strong>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>