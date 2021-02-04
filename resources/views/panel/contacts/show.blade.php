@extends('layouts.dashboard')

@section('title','Ver Contacto')

@section('title-page','Contacto')

@section('subtitle-page')
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Contacto: <b>{{ $contact->id }}</b>
        </div>

        <div class="card-body">
            @csrf
            <!--Section: Block Content-->
            {{-- fotos del producto --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>ID</strong></th>
                                    <td>{{ $contact->id }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Nombre</strong></th>
                                    <td>{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Numero Telefonico</strong></th>
                                    <td>{{ $contact->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Email</strong></th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Mensaje</strong></th>
                                    <td>{{ $contact->message }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Creado</strong></th>
                                    <td>{{ $contact->created_at }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Estado</strong></th>
                                    <td>{{ $contact->status }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"></th>
                                    <td>
                                        <form action="{{ route('dashboard.contact.update.status', $contact) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="d-flex flex-row-reverse pb-4">
                                                @if( $contact->status == 'attended' )
                                                <button class="btn btn-danger" name="status" value="non attended">
                                                    Marcar como No atendido <i class="fas fa-check-circle"></i>
                                                </button>
                                                @else
                                                <button class="btn btn-success" name="status" value="attended">
                                                    Marcar como Atendido <i class="fas fa-check-circle"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function (){
    $('#dataTable').DataTable();
});
</script>  
@endsection