@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"></h3></div>
              <div class="col-sm-6">
                
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--1 TABLE -->
          <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">CATEGORIAS</h3></div>
              <div class="col-sm-6">
                
              </div>
            </div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">DESCRIPCION</th>
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
 
      <td>
      <button class="btn btn-primary" type="button">Editar</button>
      <button class="btn btn-primary" type="button">Eliminar</button>
      </td>

    </tr>
    
  </tbody>
</table>

<!--2 TABLA MARCA -->
<div class="row">
              <div class="col-sm-6"><h3 class="mb-0">MARCAS</h3></div>
              <div class="col-sm-6">
                
              </div>
            </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">NOMBRE</th>
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      
      <td>
      <button class="btn btn-primary" type="button">Editar</button>
      <button class="btn btn-primary" type="button">Eliminar</button>
      </td>

    </tr>
    
  </tbody>
</table>

<!-- 3 TABKA MODELOS-->
<div class="row">
              <div class="col-sm-6"><h3 class="mb-0">MODELOS</h3></div>
              <div class="col-sm-6">
                
              </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">MARCAS</th>
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      
      <td>
      <button class="btn btn-primary" type="button">Editar</button>
      <button class="btn btn-primary" type="button">Eliminar</button>
      </td>

    </tr>
    
  </tbody>
</table>

<!-- 4 TABKA MODELOS-->
<div class="row">
              <div class="col-sm-6"><h3 class="mb-0">TALLAS</h3></div>
              <div class="col-sm-6">
                
              </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">NOMBRE</th>
      
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      
      <td>
      <button class="btn btn-primary" type="button">Editar</button>
      <button class="btn btn-primary" type="button">Eliminar</button>
      </td>

    </tr>
    
  </tbody>
</table>

<!-- 5 TABKA COLORES-->
<div class="row">
              <div class="col-sm-6"><h3 class="mb-0">COLORES</h3></div>
              <div class="col-sm-6">
                
              </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col"># COLOR</th>
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      
      <td>
      <button class="btn btn-primary" type="button">Editar</button>
      <button class="btn btn-primary" type="button">Eliminar</button>
      </td>

    </tr>
    
  </tbody>
</table>
            
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
@endsection