@extends('layouts.client')
@section('title', 'Rechercher un voyage')

@section('content')
{{-- Search bar --}}
<div class="card mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-search me-2 text-primary"></i>Rechercher un voyage</h5>
        <form method="GET" action="{{ route('client.voyages.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label fw-semibold small">Ville départ</label>
                    <input type="text" name="ville_depart" class="form-control"
                           value="{{ request('ville_depart') }}" placeholder="Ex: Casablanca">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label fw-semibold small">Ville arrivée</label>
                    <input type="text" name="ville_arrive" class="form-control"
                           value="{{ request('ville_arrive') }}" placeholder="Ex: Marrakech">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label fw-semibold small">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-sm-6 col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i>Rechercher
                    </button>
                    @if(request()->hasAny(['ville_depart','ville_arrive','date']))
                        <a href="{{ route('client.voyages.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Results --}}
<div class="d-flex align-items-center mb-3 gap-2">
    <h6 class="fw-bold mb-0 text-muted">{{ $voyages->count() }} voyage(s) trouvé(s)</h6>
</div>

@if($voyages->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-map text-muted" style="font-size:3rem"></i>
        <p class="text-muted mt-3">Aucun voyage ne correspond à votre recherche.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($voyages as $voyage)
        @php
            $comfortColors = ['basique' => 'secondary', 'bon' => 'primary', 'comfortable' => 'success'];
            $color = $comfortColors[$voyage->bus?->comfort] ?? 'secondary';
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    {{-- Route --}}
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="fw-bold fs-5 text-dark">{{ $voyage->ville_depart }}</div>
                            <div class="text-muted small">{{ $voyage->heure_depart }}</div>
                        </div>
                        <div class="text-center px-2">
                            <i class="bi bi-arrow-right text-primary fs-5"></i>
                            <div class="text-muted" style="font-size:.7rem">{{ $voyage->date?->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-5 text-dark">{{ $voyage->ville_arrive }}</div>
                            <div class="text-muted small">{{ $voyage->heure_arrive }}</div>
                        </div>
                    </div>

                    {{-- Badges --}}
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if($voyage->bus)
                            <span class="badge bg-{{ $color }}">
                                <i class="bi bi-star me-1"></i>{{ ucfirst($voyage->bus->comfort) }}
                            </span>
                            @if($voyage->bus->wifi)
                                <span class="badge bg-info text-dark"><i class="bi bi-wifi me-1"></i>WiFi</span>
                            @endif
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-bus-front me-1"></i>{{ $voyage->bus->modele }}
                            </span>
                        @endif
                        @if($voyage->bus?->societe)
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-building me-1"></i>{{ $voyage->bus->societe->nom }}
                            </span>
                        @endif
                    </div>

                    {{-- Agences --}}
                    <div class="text-muted small mb-3">
                        @if($voyage->agenceDepart)
                            <div><i class="bi bi-shop me-1"></i>Départ : {{ $voyage->agenceDepart->nom }}</div>
                        @endif
                        @if($voyage->agenceArrive)
                            <div><i class="bi bi-shop me-1"></i>Arrivée : {{ $voyage->agenceArrive->nom }}</div>
                        @endif
                    </div>

                    {{-- Price --}}
                    <div class="fw-bold text-primary fs-5">{{ number_format($voyage->prix, 2) }} MAD</div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('client.voyages.show', $voyage) }}" class="btn btn-primary w-100">
                        <i class="bi bi-eye me-1"></i>Voir détails & Réserver
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
