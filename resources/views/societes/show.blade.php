@extends('layouts.app')
@section('title', $societe->nom)

@section('content')
<a href="{{ route('societes.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-building-fill fs-2 text-primary"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0">{{ $societe->nom }}</h2>
                <p class="text-muted mb-0"><i class="bi bi-geo-alt me-1"></i>{{ $societe->adresse_siege }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Agences --}}
<h5 class="fw-semibold mb-3"><i class="bi bi-shop me-2 text-success"></i>Agences ({{ $societe->agences->count() }})</h5>
@if($societe->agences->isEmpty())
    <p class="text-muted">Aucune agence.</p>
@else
    <div class="row g-3 mb-4">
        @foreach($societe->agences as $agence)
        <div class="col-md-6">
            <a href="{{ route('agences.show', $agence) }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center gap-2">
                        <i class="bi bi-shop text-success fs-5"></i>
                        <div>
                            <div class="fw-semibold text-dark">{{ $agence->nom }}</div>
                            <small class="text-muted"><i class="bi bi-pin-map me-1"></i>{{ $agence->ville }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif

{{-- Buses --}}
<h5 class="fw-semibold mb-3"><i class="bi bi-bus-front me-2 text-warning"></i>Buses ({{ $societe->buses->count() }})</h5>
@if($societe->buses->isEmpty())
    <p class="text-muted mb-4">Aucun bus.</p>
@else
    <div class="row g-3 mb-4">
        @foreach($societe->buses as $bus)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('buses.show', $bus) }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center gap-2">
                        <i class="bi bi-bus-front text-warning fs-5"></i>
                        <div>
                            <div class="fw-semibold text-dark">{{ $bus->modele }}</div>
                            <small class="text-muted">{{ $bus->totale_places }} places · {{ $bus->comfort }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif

{{-- Voyages --}}
<div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-semibold mb-0"><i class="bi bi-map me-2 text-info"></i>Voyages</h5>
    <a href="{{ route('societes.voyages.create', $societe) }}" class="btn btn-sm btn-info text-white">
        <i class="bi bi-plus-circle me-1"></i>Nouveau voyage
    </a>
</div>
@endsection
