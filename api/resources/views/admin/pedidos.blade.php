@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">PEDIDOS</h3></div>
              <div class="col-sm-6">
                
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">USUARIO</th>
      <th scope="col">TOTAL</th>
      <th scope="col">ESTADO</th>
      <th scope="col">FECHA</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>
      <button type="button" class="btn btn-dark">DETALLES</button> 
      </td>
    

    </tr>
    
  </tbody>
</table>
            
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
@endsection