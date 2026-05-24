@extends('layouts.app')
@section('title', 'Nouveau bus')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('buses.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <i class="bi bi-bus-front fs-3 text-warning ms-1"></i>
    <h1 class="h3 fw-bold mb-0">Nouveau bus</h1>
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

                <form action="{{ route('buses.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-bus-front me-1 text-warning"></i>Modèle
                        </label>
                        <input type="text" name="modele" class="form-control @error('modele') is-invalid @enderror"
                               value="{{ old('modele') }}" placeholder="Ex: Mercedes Tourismo" required>
                        @error('modele')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-star me-1 text-warning"></i>Confort
                        </label>
                        <select name="comfort" class="form-select @error('comfort') is-invalid @enderror" required>
                            <option value="" disabled {{ old('comfort') ? '' : 'selected' }}>— Choisir le niveau —</option>
                            @foreach(['basique' => 'Basique', 'bon' => 'Bon', 'comfortable' => 'Comfortable'] as $val => $label)
                                <option value="{{ $val }}" {{ old('comfort') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('comfort')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-people me-1 text-warning"></i>Nombre de places
                        </label>
                        <input type="number" name="totale_places" min="1"
                               class="form-control @error('totale_places') is-invalid @enderror"
                               value="{{ old('totale_places') }}" placeholder="Ex: 40" required>
                        @error('totale_places')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="wifi" id="wifi" value="1"
                                   {{ old('wifi') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="wifi">
                                <i class="bi bi-wifi me-1 text-info"></i>WiFi à bord
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-building me-1 text-warning"></i>Société
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
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-plus-circle me-1"></i>Créer le bus
                        </button>
                        <a href="{{ route('buses.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
