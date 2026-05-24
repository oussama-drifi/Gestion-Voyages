@extends('layouts.app')
@section('title', 'Buses')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-bus-front fs-3 text-warning"></i>
        <h1 class="h3 fw-bold mb-0">Buses</h1>
        <span class="badge bg-warning text-dark ms-1">{{ $buses->count() }}</span>
    </div>
    <a href="{{ route('buses.create') }}" class="btn btn-warning text-dark">
        <i class="bi bi-plus-circle me-1"></i>Ajouter un bus
    </a>
</div>

@php
$comfortColors = ['basique' => 'secondary', 'bon' => 'primary', 'comfortable' => 'success'];
$comfortIcons  = ['basique' => 'bi-dash-circle', 'bon' => 'bi-check-circle', 'comfortable' => 'bi-star-fill'];
@endphp

@if($buses->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Aucun bus trouvé.</div>
@else
    <div class="row g-3">
        @foreach($buses as $bus)
        @php $color = $comfortColors[$bus->comfort] ?? 'secondary'; @endphp
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('buses.show', $bus) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-bus-front text-warning fs-4"></i>
                            <h5 class="card-title mb-0 fw-semibold text-dark">{{ $bus->modele }}</h5>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-{{ $color }}">
                                <i class="bi {{ $comfortIcons[$bus->comfort] ?? 'bi-circle' }} me-1"></i>{{ ucfirst($bus->comfort) }}
                            </span>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-people me-1"></i>{{ $bus->totale_places }} places
                            </span>
                            @if($bus->wifi)
                                <span class="badge bg-info text-dark"><i class="bi bi-wifi me-1"></i>WiFi</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                        @if($bus->societe)
                            <small class="text-muted"><i class="bi bi-building me-1"></i>{{ $bus->societe->nom }}</small>
                        @endif
                        <small class="text-warning ms-auto">Voir <i class="bi bi-arrow-right"></i></small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
