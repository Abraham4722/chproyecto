@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0"></h3></div>
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
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-marcas-tab" data-bs-toggle="pill" data-bs-target="#pills-marcas" type="button" role="tab" aria-controls="pills-marcas" aria-selected="false">MARCAS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-modelos-tab" data-bs-toggle="pill" data-bs-target="#pills-modelos" type="button" role="tab" aria-controls="pills-modelos" aria-selected="false">MODELOS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-tallas-tab" data-bs-toggle="pill" data-bs-target="#pills-tallas" type="button" role="tab" aria-controls="pills-tallas" aria-selected="false">TALLAS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-colores-tab" data-bs-toggle="pill" data-bs-target="#pills-colores" type="button" role="tab" aria-controls="pills-colores" aria-selected="false">COLORES</button>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="pills-tabContent">
        @foreach (['categorias', 'marcas', 'modelos', 'tallas', 'colores'] as $seccion)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $seccion }}" role="tabpanel" aria-labelledby="pills-{{ $seccion }}-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-uppercase">{{ $seccion }}</h3>
                <a href="#" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Agregar
                </a>
            </div>
            
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        @if($seccion == 'categorias') <th>DESCRIPCIÓN</th> @endif
                        @if($seccion == 'modelos') <th>MARCA</th> @endif
                        @if($seccion == 'colores') <th># COLOR</th> @endif
                        <th class="text-end">Acciones</th> <!-- Alineación a la derecha -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ejemplo</td>
                        @if($seccion == 'categorias') <td>Descripción de prueba</td> @endif
                        @if($seccion == 'modelos') <td>Marca ejemplo</td> @endif
                        @if($seccion == 'colores') <td>#FF0000</td> @endif
                        <td class="text-end">
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection
