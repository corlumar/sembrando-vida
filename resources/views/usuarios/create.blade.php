@extends('layouts.adminlte')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear usuario</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Apellido paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Apellido materno</label>
                            <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}" required>
                        </div>

                        <div class="form-group">
                            <label>CURP</label>
                            <input type="text" name="curp" class="form-control" value="{{ old('curp') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" name="celular" class="form-control" value="{{ old('celular') }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirmar password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Rol</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">Selecciona un rol</option>
                                @foreach($roles as $r)
                                    <option value="{{ $r->id }}" {{ old('role_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Estado</label>
                                <select name="estado_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach($estados as $e)
                                        <option value="{{ $e->id }}" {{ old('estado_id') == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Municipio</label>
                                <select name="municipio_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach($municipios as $m)
                                        <option value="{{ $m->id }}" {{ old('municipio_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Región</label>
                                <select name="region_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach($regiones as $rg)
                                        <option value="{{ $rg->id }}" {{ old('region_id') == $rg->id ? 'selected' : '' }}>{{ $rg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Territorio</label>
                                <select name="territorio_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach($territorios as $t)
                                        <option value="{{ $t->id }}" {{ old('territorio_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ruta</label>
                            <input type="text" name="ruta" class="form-control" value="{{ old('ruta') }}">
                        </div>

                        <button class="btn btn-primary">Crear usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
