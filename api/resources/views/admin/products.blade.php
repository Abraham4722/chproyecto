@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header  text-white p-3 rounded" style="background-color:#000c2c ">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Productos</h3>
            </div>
            <div class="col-sm-6 text-end">
                <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                    <i class="bi bi-file-plus"></i> 
                </button>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="app-content">
    <div class="bg-white p-3 rounded shadow" style="overflow-x: auto;">
        <table class="table table-striped table-hover" style="min-width: 1000px;">
            <thead class="table-dark">
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
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->talla->nombre }}</td>
                        <td><img src="{{ asset('productos/' . $producto->imagen) }}" width="50" class="rounded"></td>
                        <td>
                            <!-- Botón para editar el producto -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarProducto" data-id="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}" data-descripcion="{{ $producto->descripcion }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}" data-categoria_id="{{ $producto->categoria_id }}" data-talla_id="{{ $producto->talla_id }}" data-marca_id="{{ $producto->marca_id }}" data-imagen="{{ asset('productos/' . $producto->imagen) }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Formulario de eliminación -->
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de agregar producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="/admin/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="number" class="form-control" name="precio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" class="form-control" name="stock" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label">Categoría:</label>
                            <select class="form-select" name="categoria_id">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="talla_id" class="form-label">Talla:</label>
                            <select class="form-select" name="talla_id">
                                @foreach($tallas as $talla)
                                    <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="marca_id" class="form-label">Marca:</label>
                            <select class="form-select" name="marca_id">
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input type="file" class="form-control" name="imagen" required>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success w-100">Agregar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de editar producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" value="{{$producto->nombre}}" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" value="{{$producto->descripcion}}" name="descripcion" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="number" value="{{$producto->precio}}" class="form-control" name="precio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" value="{{$producto->stock}}" class="form-control" name="stock" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label">Categoría:</label>
                            <select class="form-select" name="categoria_id">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="talla_id" class="form-label">Talla:</label>
                            <select class="form-select" name="talla_id">
                                @foreach($tallas as $talla)
                                    <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="marca_id" class="form-label">Marca:</label>
                            <select class="form-select" name="marca_id">
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input type="file" value="{{$producto->imagen}}" class="form-control" name="imagen">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-warning w-100">Actualizar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
