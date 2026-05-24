@extends('layouts.app')
@section('title', 'Nouvelle société')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('societes.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <i class="bi bi-building fs-3 text-primary ms-1"></i>
    <h1 class="h3 fw-bold mb-0">Nouvelle société</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('societes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-building me-1 text-primary"></i>Nom de la société
                        </label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}" placeholder="Ex: TransMaghreb" required>
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-geo-alt me-1 text-primary"></i>Adresse du siège
                        </label>
                        <input type="text" name="adresse_siege" class="form-control @error('adresse_siege') is-invalid @enderror"
                               value="{{ old('adresse_siege') }}" placeholder="Ex: 12 Rue Hassan II, Casablanca" required>
                        @error('adresse_siege')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Créer la société
                        </button>
                        <a href="{{ route('societes.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
