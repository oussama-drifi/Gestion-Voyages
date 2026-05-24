@extends('layouts.app')
@section('title', $voyage->ville_depart.' → '.$voyage->ville_arrive)

@section('content')
<a href="{{ route('voyages.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 p-3 bg-info bg-opacity-10">
                <i class="bi bi-map fs-2 text-info"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0">{{ $voyage->ville_depart }} <i class="bi bi-arrow-right text-info"></i> {{ $voyage->ville_arrive }}</h2>
                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ $voyage->date?->format('d/m/Y') }}</span>
                @if($voyage->voyage_principale_id)
                    <span class="badge bg-secondary ms-2">Sous-voyage</span>
                @endif
            </div>
        </div>

        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-clock me-1"></i>Départ</div>
                    <div class="fw-semibold">{{ $voyage->heure_depart }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-clock-history me-1"></i>Arrivée</div>
                    <div class="fw-semibold">{{ $voyage->heure_arrive }}</div>
                </div>
            </div>
            @if($voyage->agenceDepart)
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-shop me-1"></i>Agence départ</div>
                    <a href="{{ route('agences.show', $voyage->agenceDepart) }}" class="fw-semibold text-decoration-none">
                        {{ $voyage->agenceDepart->nom }}
                    </a>
                </div>
            </div>
            @endif
            @if($voyage->agenceArrive)
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-shop me-1"></i>Agence arrivée</div>
                    <a href="{{ route('agences.show', $voyage->agenceArrive) }}" class="fw-semibold text-decoration-none">
                        {{ $voyage->agenceArrive->nom }}
                    </a>
                </div>
            </div>
            @endif
            @if($voyage->bus)
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-bus-front me-1"></i>Bus</div>
                    <a href="{{ route('buses.show', $voyage->bus) }}" class="fw-semibold text-decoration-none">
                        {{ $voyage->bus->modele }}
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@if($voyage->voyagePrincipale)
<div class="alert alert-secondary d-flex align-items-center gap-2">
    <i class="bi bi-diagram-2"></i>
    Voyage principal :
    <a href="{{ route('voyages.show', $voyage->voyagePrincipale) }}" class="ms-1 fw-semibold">
        {{ $voyage->voyagePrincipale->ville_depart }} → {{ $voyage->voyagePrincipale->ville_arrive }}
    </a>
</div>
@endif

@if($voyage->sousVoyages->isNotEmpty())
<h5 class="fw-semibold mb-3"><i class="bi bi-diagram-3 me-2 text-secondary"></i>Sous-voyages ({{ $voyage->sousVoyages->count() }})</h5>
<div class="row g-3">
    @foreach($voyage->sousVoyages as $sv)
    <div class="col-md-6">
        <a href="{{ route('voyages.show', $sv) }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center gap-2">
                    <i class="bi bi-signpost-split text-secondary fs-5"></i>
                    <div>
                        <div class="fw-semibold text-dark">{{ $sv->ville_depart }} → {{ $sv->ville_arrive }}</div>
                        <small class="text-muted">{{ $sv->date?->format('d/m/Y') }} · {{ $sv->heure_depart }}</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif
@endsection
