@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')
<div class="mb-4">
    <h1 class="h3 fw-bold"><i class="bi bi-speedometer2 me-2 text-primary"></i>Tableau de bord</h1>
    <p class="text-muted">Vue d'ensemble du système de gestion des voyages</p>
</div>

@php
$cards = [
    ['route' => 'societes.index', 'icon' => 'bi-building',           'label' => 'Sociétés',  'count' => $stats['societes'], 'color' => 'primary'],
    ['route' => 'agences.index',  'icon' => 'bi-shop',               'label' => 'Agences',   'count' => $stats['agences'],  'color' => 'success'],
    ['route' => 'buses.index',    'icon' => 'bi-bus-front',          'label' => 'Buses',     'count' => $stats['buses'],    'color' => 'warning'],
    ['route' => 'voyages.index',  'icon' => 'bi-map',                'label' => 'Voyages',   'count' => $stats['voyages'],  'color' => 'info'],
    ['route' => 'tickets.index',  'icon' => 'bi-ticket-perforated',  'label' => 'Tickets',   'count' => $stats['tickets'],  'color' => 'danger'],
];
@endphp

<div class="row g-4">
    @foreach($cards as $card)
    <div class="col-sm-6 col-lg-4">
        <a href="{{ route($card['route']) }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <div class="rounded-3 p-3 bg-{{ $card['color'] }} bg-opacity-10">
                        <i class="bi {{ $card['icon'] }} fs-2 text-{{ $card['color'] }}"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold text-dark">{{ $card['count'] }}</div>
                        <div class="text-muted small">{{ $card['label'] }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection
