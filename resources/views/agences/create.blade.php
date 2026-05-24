@extends('layouts.app')
@section('title', 'Nouvelle agence')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('agences.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <i class="bi bi-shop fs-3 text-success ms-1"></i>
    <h1 class="h3 fw-bold mb-0">Nouvelle agence</h1>
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

                <form action="{{ route('agences.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-shop me-1 text-success"></i>Nom de l'agence
                        </label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}" placeholder="Ex: Agence Centrale" required>
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-pin-map me-1 text-success"></i>Ville
                        </label>
                        <input type="text" name="ville" class="form-control @error('ville') is-invalid @enderror"
                               value="{{ old('ville') }}" placeholder="Ex: Casablanca" required>
                        @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-signpost me-1 text-success"></i>Adresse
                        </label>
                        <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                               value="{{ old('adresse') }}" placeholder="Ex: 5 Avenue Mohammed V" required>
                        @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-building me-1 text-success"></i>Société
                        </label>
                        <select name="societe_id" class="form-select @error('societe_id') is-invalid @enderror" required>
                            <option value="" disabled {{ old('societe_id') ? '' : 'selected' }}>— Choisir une société —</option>
                            @foreach($societes as $societe)
                                <option value="{{ $societe->societe_id }}" {{ old('societe_id') == $societe->societe_id ? 'selected' : '' }}>
                                    {{ $societe->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('societe_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i>Créer l'agence
                        </button>
                        <a href="{{ route('agences.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
