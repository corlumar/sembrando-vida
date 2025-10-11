@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Bienvenido, {{ $user->name }}</h1>
    <p>Tu rol actual es: <strong>{{ $user->role ?? 'sin rol' }}</strong></p>

    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>150</h3>
                    <p>CAC registrados</p>
                </div>
                <div class="icon"><i class="fas fa-warehouse"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>350</h3>
                    <p>Sembradores</p>
                </div>
                <div class="icon"><i class="fas fa-user-friends"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection
