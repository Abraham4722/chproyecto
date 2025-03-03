@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Productos</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <!-- Formulario para agregar un nuevo producto -->
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea class="form-control" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" class="form-control" name="precio" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" class="form-control" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <input type="text" class="form-control" name="categoria" required>
        </div>
        <div class="mb-3">
            <label for="talla" class="form-label">Talla:</label>
            <input type="text" class="form-control" name="talla" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" name="imagen" required>
        </div>
        <button type="submit" class="btn btn-success">Agregar Producto</button>
    </form>

    <hr>

    <!-- Tabla de productos -->
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>CATEGORÍA</th>
                <th>TALLA</th>
                <th>IMAGEN</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>{{ $producto->precio }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria }}</td>
            <td>{{ $producto->talla }}</td>
            <td><img src="{{ asset('storage/' . $producto->imagen) }}" width="50"></td>
            <td>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</table>
</div>
@endsection
