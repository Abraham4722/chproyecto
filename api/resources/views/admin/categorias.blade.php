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
        <!-- Categorías -->
        <div class="tab-pane fade show active" id="pills-categorias" role="tabpanel" aria-labelledby="pills-categorias-tab">
            <h3>CATEGORIAS</h3>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Marcas -->
        <div class="tab-pane fade" id="pills-marcas" role="tabpanel" aria-labelledby="pills-marcas-tab">
            <h3>MARCAS</h3>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modelos -->
        <div class="tab-pane fade" id="pills-modelos" role="tabpanel" aria-labelledby="pills-modelos-tab">
            <h3>MODELOS</h3>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        <th>MARCAS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tallas -->
        <div class="tab-pane fade" id="pills-tallas" role="tabpanel" aria-labelledby="pills-tallas-tab">
            <h3>TALLAS</h3>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Colores -->
        <div class="tab-pane fade" id="pills-colores" role="tabpanel" aria-labelledby="pills-colores-tab">
            <h3>COLORES</h3>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        <th># COLOR</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
