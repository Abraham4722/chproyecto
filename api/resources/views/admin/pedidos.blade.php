@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header bg-primary-dark text-light py-3 px-4 shadow-lg rounded">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 text-highlight">PEDIDOS</h3>
            </div>
           
        </div>
    </div>
</div>

<div class="app-content mt-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover shadow-lg rounded">
            <thead class="text-highlight border-highlight">
                <tr>
                    <th>#ID</th>
                    <th>USUARIO</th>
                    <th>TOTAL</th>
                    <th>ESTADO</th>
                    <th>FECHA</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover-row">
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>$100</td>
                    <td>Pendiente</td>
                    <td>2025-03-04</td>
                    <td>
                        <a href="/admin/detalles/1" class="btn btn-highlight">DETALLES</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        background-color: #000c2c;
        color: #e0e0e0;
    }
    .bg-primary-dark {
        background-color: #000c2c;
        border-radius: 10px;
    }
    .text-highlight {
        color: #ffd700;
        text-shadow: 0 0 10px #ffd700, 0 0 20px #ffd700;
    }
    .btn-highlight {
        background: transparent;
        border: 2px solid #ffd700;
        color: #ffd700;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-highlight:hover {
        background: #ffd700;
        color: #000c2c;
        box-shadow: 0 0 10px #ffd700, 0 0 40px #ffd700;
    }
    .table-dark {
        background-color: #001a4d;
        border-radius: 10px;
        overflow: hidden;
    }
    .border-highlight {
        border-bottom: 2px solid #ffd700;
    }
    .hover-row:hover {
        background-color: rgba(255, 215, 0, 0.2);
    }
</style>
@endsection