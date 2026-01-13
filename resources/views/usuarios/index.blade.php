@extends('layouts.adminlte')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
            <h3>Usuarios</h3>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear usuario</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>CURP</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role?->name }}</td>
                                    <td>{{ $user->curp }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No hay usuarios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
