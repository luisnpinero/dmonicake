@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('title','Contacto')

@section('title-page','Contacto')

@section('subtitle-page','Módulo de Contacto')

@section('content')

<div class="card mb-4">

<div class="card-body">

    <div class="table-responsive table-hover">
        <table class="table table-bordered table-striped" id="dataTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Teléfono</th>
                    <th>Email</th>
                    <th>Creado</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Teléfono</th>
                    <th>Email</th>
                    <th>Creado</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone_number }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->created_at}}</td>
                        <td>{{ $contact->message}}</td>
                        <td>{{ $contact->status}}</td>
                        <td><div class="d-flex justify-content-around">
                            <button class="btn btn-sm px-0 mx-0">
                                <a href="{{ route('dashboard.contact.show', $contact->id) }}" title="Ver"><i class="fas fa-eye fas-icon-purple"></i></a> 
                            </button>

                            <form action="{{ route('dashboard.contact.update.status', $contact) }}" method="post">
                                @csrf
                                @method('put')

                                @if( $contact->status == 'attended' )
                                    <button class="btn btn-sm px-0 mx-0" name="status" value="non attended">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </button>
                                @else
                                    <button class="btn btn-sm px-0 mx-0" name="status" value="attended">
                                        <i class="far fa-check-circle text-danger"></i>
                                    </button> 
                                @endif
                            </form>

                            </div>
                        </td>
                    </tr>
                @endforeach                    
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

@section('scripts')
  
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>  
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
        });
    </script>  
@endsection