@extends('layouts.app')
@section('title', 'Nouveau voyage — '.$societe->nom)

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('societes.show', $societe) }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <i class="bi bi-map fs-3 text-info ms-1"></i>
    <h1 class="h3 fw-bold mb-0">Nouveau voyage</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">

        {{-- Société badge (read-only) --}}
        <div class="alert alert-light border d-flex align-items-center gap-2 mb-4 py-2">
            <i class="bi bi-building text-primary"></i>
            <span class="fw-semibold">{{ $societe->nom }}</span>
            <span class="text-muted small ms-1">— tous les agences, buses et voyages ci-dessous appartiennent à cette société</span>
        </div>

        <div class="card">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('societes.voyages.store', $societe) }}" method="POST">
                    @csrf

                    {{-- Villes --}}
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-geo-alt me-1 text-info"></i>Ville départ</label>
                            <input type="text" name="ville_depart" class="form-control @error('ville_depart') is-invalid @enderror"
                                   value="{{ old('ville_depart') }}" placeholder="Ex: Casablanca" required>
                            @error('ville_depart')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1 text-info"></i>Ville arrivée</label>
                            <input type="text" name="ville_arrive" class="form-control @error('ville_arrive') is-invalid @enderror"
                                   value="{{ old('ville_arrive') }}" placeholder="Ex: Marrakech" required>
                            @error('ville_arrive')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Date + heures --}}
                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <label class="form-label fw-semibold"><i class="bi bi-calendar3 me-1 text-info"></i>Date</label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                   value="{{ old('date') }}" required>
                            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label fw-semibold"><i class="bi bi-clock me-1 text-info"></i>Heure départ</label>
                            <input type="time" name="heure_depart" class="form-control @error('heure_depart') is-invalid @enderror"
                                   value="{{ old('heure_depart') }}" required>
                            @error('heure_depart')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label fw-semibold"><i class="bi bi-clock-history me-1 text-info"></i>Heure arrivée</label>
                            <input type="time" name="heure_arrive" class="form-control @error('heure_arrive') is-invalid @enderror"
                                   value="{{ old('heure_arrive') }}" required>
                            @error('heure_arrive')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Agences --}}
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-shop me-1 text-info"></i>Agence départ</label>
                            <select name="agence_depart_id" class="form-select @error('agence_depart_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('agence_depart_id') ? '' : 'selected' }}>— Choisir —</option>
                                @foreach($societe->agences as $agence)
                                    <option value="{{ $agence->agence_id }}" {{ old('agence_depart_id') == $agence->agence_id ? 'selected' : '' }}>
                                        {{ $agence->nom }} — {{ $agence->ville }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agence_depart_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-shop me-1 text-info"></i>Agence arrivée</label>
                            <select name="agence_arrive_id" class="form-select @error('agence_arrive_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('agence_arrive_id') ? '' : 'selected' }}>— Choisir —</option>
                                @foreach($societe->agences as $agence)
                                    <option value="{{ $agence->agence_id }}" {{ old('agence_arrive_id') == $agence->agence_id ? 'selected' : '' }}>
                                        {{ $agence->nom }} — {{ $agence->ville }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agence_arrive_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Bus + Prix --}}
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-bus-front me-1 text-info"></i>Bus</label>
                            <select name="bus_id" class="form-select @error('bus_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('bus_id') ? '' : 'selected' }}>— Choisir —</option>
                                @foreach($societe->buses as $bus)
                                    <option value="{{ $bus->bus_id }}" {{ old('bus_id') == $bus->bus_id ? 'selected' : '' }}>
                                        {{ $bus->modele }} — {{ $bus->totale_places }} places ({{ ucfirst($bus->comfort) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('bus_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold"><i class="bi bi-cash me-1 text-info"></i>Prix (MAD)</label>
                            <input type="number" name="prix" step="0.01" min="0"
                                   class="form-control @error('prix') is-invalid @enderror"
                                   value="{{ old('prix') }}" placeholder="Ex: 120.00" required>
                            @error('prix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Voyage principal --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-diagram-2 me-1 text-info"></i>Voyage principal
                            <span class="text-muted fw-normal">(optionnel — pour créer un sous-voyage)</span>
                        </label>
                        <select name="voyage_principale_id" class="form-select @error('voyage_principale_id') is-invalid @enderror">
                            <option value="">— Aucun (voyage principal) —</option>
                            @foreach($parentVoyages as $v)
                                <option value="{{ $v->voyage_id }}" {{ old('voyage_principale_id') == $v->voyage_id ? 'selected' : '' }}>
                                    {{ $v->ville_depart }} → {{ $v->ville_arrive }} — {{ $v->date?->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('voyage_principale_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-info text-white">
                            <i class="bi bi-plus-circle me-1"></i>Créer le voyage
                        </button>
                        <a href="{{ route('societes.show', $societe) }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
