<aside class="app-sidebar shadow" data-bs-theme="dark" style="background-color:#010c2a;">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="/img/fondo2.jpg"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">CH-SHIRTS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              
              <li class="nav-item">
                <a href="{{url('/admin') }}" class="nav-link">
                  <i class="nav-icon bi bi-house"></i>
                  <p>HOME</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/admin/products') }}" class="nav-link">
                  <i class="nav-icon bi bi-list-check"></i>
                  <p>PRODUCTOS</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/admin/pedidos') }}" class="nav-link">
                  <i class="nav-icon bi bi-bag"></i>
                  <p>PEDIDOS</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{url('/admin/categorias') }}" class="nav-link">
                  <i class="nav-icon bi  bi-tags"></i>
                  <p>CATEGORIAS</p>
                </a>
              </li>


              <!--<li class="nav-item">
                <a href="{{url('/admin/envios') }}" class="nav-link">
                  <i class="nav-icon bi bi-truck"></i>
                  <p>ENVIOS</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="{{url('/admin/pagos') }}" class="nav-link">
                  <i class="nav-icon bi bi-cash-coin"></i>
                  <p>PAGOS</p>
                </a>
              </li>
              -->

              
              <li class="nav-item">
                <a href="{{url('/admin/clientes') }}" class="nav-link">
                  <i class="nav-icon bi  bi-people"></i>
                  <p>CLIENTES</p>
                </a>
              </li>


             


            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>