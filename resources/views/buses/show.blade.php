@extends('layouts.app')
@section('title', $bus->modele)

@section('content')
<a href="{{ route('buses.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

@php
$comfortColors = ['basique' => 'secondary', 'bon' => 'primary', 'comfortable' => 'success'];
$color = $comfortColors[$bus->comfort] ?? 'secondary';
@endphp

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 p-3 bg-warning bg-opacity-10">
                <i class="bi bi-bus-front fs-2 text-warning"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">{{ $bus->modele }}</h2>
                @if($bus->societe)
                    <a href="{{ route('societes.show', $bus->societe) }}" class="text-muted text-decoration-none small">
                        <i class="bi bi-building me-1"></i>{{ $bus->societe->nom }}
                    </a>
                @endif
            </div>
        </div>

        <div class="row g-3">
            <div class="col-sm-4">
                <div class="p-3 bg-light rounded-3 text-center">
                    <i class="bi bi-star-fill fs-4 text-{{ $color }} mb-1 d-block"></i>
                    <div class="small text-muted">Confort</div>
                    <span class="badge bg-{{ $color }} mt-1">{{ ucfirst($bus->comfort) }}</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 bg-light rounded-3 text-center">
                    <i class="bi bi-people fs-4 text-primary mb-1 d-block"></i>
                    <div class="small text-muted">Places</div>
                    <div class="fw-bold fs-5">{{ $bus->totale_places }}</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 bg-light rounded-3 text-center">
                    @if($bus->wifi)
                        <i class="bi bi-wifi fs-4 text-info mb-1 d-block"></i>
                        <div class="small text-muted">WiFi</div>
                        <span class="badge bg-info text-dark mt-1">Disponible</span>
                    @else
                        <i class="bi bi-wifi-off fs-4 text-muted mb-1 d-block"></i>
                        <div class="small text-muted">WiFi</div>
                        <span class="badge bg-secondary mt-1">Non disponible</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
