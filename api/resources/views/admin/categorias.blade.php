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
    <!-- Navegación de pestañas -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-categorias-tab" data-bs-toggle="pill" data-bs-target="#pills-categorias" type="button" role="tab" aria-controls="pills-categorias" aria-selected="true">CATEGORIAS</button>
        </li>
        <!-- Otras pestañas aquí... -->
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="pills-tabContent">
        <!-- Pestaña de Categorías -->
        <div class="tab-pane fade show active" id="pills-categorias" role="tabpanel" aria-labelledby="pills-categorias-tab">
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

            <table class="table table-hover">
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
                            <img src="{{ asset('storage/'.$categoria->imagen) }}" width="50" class="img-thumbnail">
                            @endif
                        </td>
                       <td class="text-end">
                            <!-- Botón Editar -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria" 
                                onclick="editarCategoria({{ json_encode($categoria) }})">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Formulario de Eliminación -->
                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">
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
</div>

<!-- Modal para agregar/editar categorías -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategoriaLabel">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCategoria" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="categoria_id" name="id">
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

<!-- Modal para Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarCategoriaLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarCategoria" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editar_categoria_id" name="id">
                <div class="modal-body">
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

@endsection

@section('script')
<script>
    // Función para editar categoría (versión corregida)
    function editarCategoria(categoria) {
        const form = document.getElementById('formEditarCategoria');
        const modalTitle = document.getElementById('modalEditarCategoriaLabel');
        const imagenPreview = document.getElementById('editarImagenPreview');

        form.action = `/admin/categorias/${categoria.id}`;
        document.getElementById('editar_categoria_id').value = categoria.id;
        document.getElementById('editar_nombre').value = categoria.nombre || '';
        document.getElementById('editar_descripcion').value = categoria.descripcion || '';

        // Mostrar la imagen actual si existe
        imagenPreview.innerHTML = categoria.imagen 
            ? `<img src="/storage/${categoria.imagen}" width="100" class="img-thumbnail">`
            : '';
    }

    // Configuración inicial del modal para agregar categoría
    document.getElementById('modalCategoria').addEventListener('show.bs.modal', function (event) {
        const form = document.getElementById('formCategoria');
        form.reset();
        form.action = "{{ route('admin.categorias.store') }}";
        document.querySelector('input[name="_method"]')?.remove();
        document.getElementById('modalCategoriaLabel').textContent = 'Agregar Categoría';
        document.getElementById('imagenPreview').innerHTML = '';
    });
</script>
@endsection
