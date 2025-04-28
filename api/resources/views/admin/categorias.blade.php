@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Gestión de Productos</h3></div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<div class="app-content">
    <!-- Navegación de pestañas mejorada -->
    <ul class="nav nav-tabs mb-4" id="product-management-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="categorias-tab" data-bs-toggle="tab" data-bs-target="#categorias-content" type="button" role="tab">
                <i class="bi bi-tags me-2"></i>CATEGORÍAS
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="marcas-tab" data-bs-toggle="tab" data-bs-target="#marcas-content" type="button" role="tab">
                <i class="bi bi-star me-2"></i>MARCAS
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="modelos-tab" data-bs-toggle="tab" data-bs-target="#modelos-content" type="button" role="tab">
                <i class="bi bi-box-seam me-2"></i>MODELOS
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tallas-tab" data-bs-toggle="tab" data-bs-target="#tallas-content" type="button" role="tab">
                <i class="bi bi-rulers me-2"></i>TALLAS
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="colores-tab" data-bs-toggle="tab" data-bs-target="#colores-content" type="button" role="tab">
                <i class="bi bi-palette me-2"></i>COLORES
            </button>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="product-management-content">
        <!-- Contenido de Categorías (sin cambios) -->
        <div class="tab-pane fade show active" id="categorias-content" role="tabpanel" aria-labelledby="categorias-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-uppercase">Categorías</h3>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                    <i class="bi bi-plus-circle"></i> Agregar
                </button>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive rounded-3 shadow-sm">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>IMAGEN</th>
                            <th class="text-end">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion ?? 'N/A' }}</td>
                            <td>
                                @if($categoria->imagen)
                                <img src="{{ asset('storage/'.$categoria->imagen) }}" width="50" class="img-thumbnail rounded">
                                @endif
                            </td>
                            <td class="text-end">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria" 
                                    onclick="editarCategoria({{ json_encode($categoria) }})">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Contenido de Marcas -->
        <div class="tab-pane fade" id="marcas-content" role="tabpanel" aria-labelledby="marcas-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-uppercase">Marcas</h3>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMarca">
                    <i class="bi bi-plus-circle"></i> Agregar
                </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="table-responsive rounded-3 shadow-sm">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>NOMBRE</th>
                           
                            <th class="text-end">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                            
                         
                            <td class="text-end">
                           
                            <button class="btn btn-outline-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditarMarca" 
                                    onclick="editarMarca({{ json_encode($marca) }})">  <!-- Cambiado de $marcas a $marca -->
                                <i class="bi bi-pencil"></i>
                            </button>
                               

                                <form action="{{ route('admin.marcas.destroy', $marca->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta marca?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Contenido de agregar Modelos -->
        <div class="tab-pane fade" id="modelos-content" role="tabpanel" aria-labelledby="modelos-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 text-uppercase">Modelos</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalModelo">
                <i class="bi bi-plus-circle"></i> Agregar
            </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
                    <th class="text-end">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($modelos as $modelo)
                <tr>
                    <td>{{ $modelo->id }}</td>
                    <td>{{ $modelo->nombre }}</td>
                    <td>{{ $modelo->marca->nombre ?? 'N/A' }}</td>
                    <td class="text-end">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarModelo" 
                        onclick="editarModelo({{ json_encode($modelo) }})">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <form action="{{ route('admin.modelos.destroy', $modelo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este modelo?')">
                        <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
      
        


        <!-- Contenido de agregar Tallas -->
        <div class="tab-pane fade" id="tallas-content" role="tabpanel" aria-labelledby="tallas-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 text-uppercase">Tallas</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTalla">
                <i class="bi bi-plus-circle"></i> Agregar
            </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>NOMBRE</th>
                    <th class="text-end">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tallas as $talla)
                <tr>
                    <td>{{ $talla->id }}</td>
                    <td>{{ $talla->nombre }}</td>
                    <td class="text-end">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarTalla" 
                        onclick="editarTalla({{ json_encode($talla) }})">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <form action="{{ route('admin.tallas.destroy', $talla->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta talla?')">
                        <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>

        
        <!-- Contenido AREGAR de Colores -->
        <div class="tab-pane fade" id="colores-content" role="tabpanel" aria-labelledby="colores-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 text-uppercase">Colores</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalColor">
                <i class="bi bi-plus-circle"></i> Agregar
            </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>NOMBRE</th>
                    <th>CÓDIGO HEX</th>
                    <th class="text-end">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($colores as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->nombre }}</td>
                    <td>
                    <span class="d-inline-block rounded-circle" style="width: 20px; height: 20px; background-color: {{ $color->codigo_hex }};"></span>
                    {{ $color->codigo_hex }}
                    </td>
                    <td class="text-end">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarColor" 
                        onclick="editarColor({{ json_encode($color) }})">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <form action="{{ route('admin.colores.destroy', $color->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este color?')">
                        <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>

<!--    MODALEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEES PARA AGREGAR Y EDITAR-->

<!-- Modal para agregar categoría (sin cambios) -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategoriaLabel">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCategoria" method="POST" enctype="multipart/form-data" action="{{ route('admin.categorias.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                        <div id="imagenPreview" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Categoría (sin cambios) -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarCategoriaLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarCategoria" method="POST" enctype="multipart/form-data" 
                action="{{ route('admin.categorias.update', ':id') }}">  <!-- Cambio clave aquí -->
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar_categoria_id" name="id">
                    <div class="mb-3">
                        <label for="editar_nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editar_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editar_descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editar_imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="editar_imagen" name="imagen">
                        <div id="editarImagenPreview" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modales para las nuevas secciones (estructura básica) -->
<!-- Modal para agregar Marcas -->
<div class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="modalMarcaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMarcaLabel">Agregar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMarca" method="POST" enctype="multipart/form-data" action="{{ route('admin.marca.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Marca-->
<!-- Modal para Editar Marca -->
<div class="modal fade" id="modalEditarMarca" tabindex="-1" aria-labelledby="modalEditarMarcaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarMarcaLabel">Editar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarMarca" method="POST" action="{{ route('admin.marcas.update', 'REPLACE_ID') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar_marca_id" name="id">
                    <div class="mb-3">
                        <label for="editar_nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para agregar Modelos -->
<div class="modal fade" id="modalModelo" tabindex="-1" aria-labelledby="modalModeloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModeloLabel">Agregar Modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formModelo" method="POST" enctype="multipart/form-data" action="{{ route('admin.modelos.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="marca_id" class="form-label">Marca *</label>
                        <select class="form-select" id="marca_id" name="marca_id" required>
                            <option value="" selected disabled>Seleccione una marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>










 






 






<!-- Modal para Editar Modelo -->
<div class="modal fade" id="modalEditarModelo" tabindex="-1" aria-labelledby="modalEditarModeloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarModeloLabel">Editar Modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarModelo" method="POST" enctype="multipart/form-data" action="{{ route('admin.modelos.update', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar_modelo_id" name="id">
                    <div class="mb-3">
                        <label for="editar_nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editar_marca_id" class="form-label">Marca *</label>
                        <select class="form-select" id="editar_marca_id" name="marca_id" required>
                            <option value="" selected disabled>Seleccione una marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>







<!-- Modal para Tallas -->
<!-- Modal para agregar Tallas -->
<div class="modal fade" id="modalTalla" tabindex="-1" aria-labelledby="modalTallaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTallaLabel">Agregar Talla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTalla" method="POST" enctype="multipart/form-data" action="{{ route('admin.tallas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Talla -->

<div class="modal fade" id="modalEditarTalla" tabindex="-1" aria-labelledby="modalEditarTallaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarTallaLabel">Editar Talla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarTalla" method="POST" enctype="multipart/form-data" action="{{ route('admin.tallas.update', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar_talla_id" name="id">
                    <div class="mb-3">
                        <label for="editar_nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
 


<!-- Modal para AGREGAR Colores -->
<div class="modal fade" id="modalColor" tabindex="-1" aria-labelledby="modalColorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalColorLabel">Agregar Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formColor" method="POST" action="{{ route('admin.colores.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_hex" class="form-label">Código Hex *</label>
                        <input type="color" class="form-control form-control-color" id="codigo_hex" name="codigo_hex" value="#000000" title="Elige un color" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal para Editar Color -->

<div class="modal fade" id="modalEditarColor" tabindex="-1" aria-labelledby="modalEditarColorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarColorLabel">Editar Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarColor" method="POST" enctype="multipart/form-data" action="{{ route('admin.colores.update', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar_color_id" name="id">
                    <div class="mb-3">
                        <label for="editar_nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editar_codigo_hex" class="form-label">Código Hex *</label>
                        <input type="color" class="form-control form-control-color" id="editar_codigo_hex" name="codigo_hex" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
 


</div>

@endsection

@section('script')
<script>
    // Función para editar categoría
    function editarCategoria(categoria) {
        const form = document.getElementById('formEditarCategoria');
        form.action = "{{ route('admin.categorias.update', ':id') }}".replace(':id', categoria.id);
        document.getElementById('editar_categoria_id').value = categoria.id;
        document.getElementById('editar_nombre').value = categoria.nombre || '';
        document.getElementById('editar_descripcion').value = categoria.descripcion || '';
        
        // Mostrar previsualización de imagen si existe
        const imagenPreview = document.getElementById('editarImagenPreview');
        if (categoria.imagen) {
            imagenPreview.innerHTML = `<img src="/storage/${categoria.imagen}" width="100" class="img-thumbnail">`;
        } else {
            imagenPreview.innerHTML = '';
        }
    }

    // Función para editar marca
    function editarMarca(marca) {
    // Verifica que el objeto marca tenga ID
    if (!marca || !marca.id) {
        console.error("Objeto marca inválido o sin ID:", marca);
        return;
    }

    const form = document.getElementById('formEditarMarca');
    if (!form) {
        console.error("Formulario no encontrado");
        return;
    }

    // Actualiza la URL del formulario
    const newAction = form.action.replace('REPLACE_ID', marca.id);
    form.setAttribute('action', newAction);
    
    // Rellena los campos
    document.getElementById('editar_marca_id').value = marca.id;
    document.getElementById('editar_nombre').value = marca.nombre || '';
    
    console.log("URL actualizada:", form.action); // Para depuración
}
    // Función para editar modelo
    function editarModelo(modelo) {
        const form = document.getElementById('formEditarModelo');
        form.action = "{{ route('admin.modelos.update', ':id') }}".replace(':id', modelo.id);
        document.getElementById('editar_modelo_id').value = modelo.id;
        document.getElementById('editar_nombre').value = modelo.nombre || '';
        
        // Seleccionar la marca correspondiente en el dropdown
        const marcaSelect = document.getElementById('editar_marca_id');
        if (marcaSelect) {
            marcaSelect.value = modelo.marca_id || '';
        }
    }

    // Función para editar talla
    function editarTalla(talla) {
        const form = document.getElementById('formEditarTalla');
        form.action = "{{ route('admin.tallas.update', ':id') }}".replace(':id', talla.id);
        document.getElementById('editar_talla_id').value = talla.id;
        document.getElementById('editar_nombre').value = talla.nombre || '';
    }

    // Función para editar color
    function editarColor(color) {
        const form = document.getElementById('formEditarColor');
        form.action = "{{ route('admin.colores.update', ':id') }}".replace(':id', color.id);
        document.getElementById('editar_color_id').value = color.id;
        document.getElementById('editar_nombre').value = color.nombre || '';
        document.getElementById('editar_codigo_hex').value = color.codigo_hex || '#000000';
    }

    // Manejo de pestañas y hash en la URL
    document.addEventListener('DOMContentLoaded', function() {
        // Activar pestaña según hash en URL
        if (window.location.hash) {
            const tabElement = document.querySelector(`button[data-bs-target="${window.location.hash}"]`);
            if (tabElement) {
                new bootstrap.Tab(tabElement).show();
            }
        }

        // Actualizar hash cuando se cambia de pestaña
        const tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabElements.forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                if (target) {
                    window.location.hash = target;
                }
            });
        });
        
        // Inicializar campos de color
        const colorInputs = document.querySelectorAll('input[type="color"]');
        colorInputs.forEach(input => {
            if (!input.value) {
                input.value = '#000000';
            }
        });
    });
</script>
@endsection