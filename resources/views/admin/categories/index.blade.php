@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">
            Categorias
        </h1>

        <p class="text-muted mb-0">
            Gerenciamento das categorias dos eventos.
        </p>
    </div>

    <a 
        href="{{ route('admin.categories.create') }}" 
        class="btn btn-primary"
    >
        Nova categoria
    </a>
</div>

@endsection
