@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Detalles del Pedido</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ url('/admin/pedidos') }}" class="btn btn-secondary">Volver a pedidos</a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Información del Pedido</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID del Pedido:</strong> {{ $pedido->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
                        <p><strong>Estado:</strong> <span class="badge bg-success">{{ $pedido->estado }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Productos en el Pedido</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->pivot->cantidad }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>${{ number_format($producto->pivot->cantidad * $producto->precio, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection