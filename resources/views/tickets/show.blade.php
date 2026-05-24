@extends('layouts.app')
@section('title', 'Ticket #'.$ticket->ticket_id)

@section('content')
<a href="{{ route('tickets.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

@php $isValid = $ticket->statut === 'validé'; @endphp

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 p-3 bg-danger bg-opacity-10">
                <i class="bi bi-ticket-perforated fs-2 text-danger"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">Ticket #{{ $ticket->ticket_id }}</h2>
                <span class="badge bg-{{ $isValid ? 'success' : 'danger' }} fs-6">
                    <i class="bi bi-{{ $isValid ? 'check-circle' : 'x-circle' }} me-1"></i>{{ ucfirst($ticket->statut) }}
                </span>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-person-seat me-1"></i>Numéro de place</div>
                    <div class="fw-bold fs-5">{{ $ticket->numero_place }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-cash me-1"></i>Prix</div>
                    <div class="fw-bold fs-5">{{ number_format($ticket->prix, 2) }} MAD</div>
                </div>
            </div>
            @if($ticket->user)
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-person me-1"></i>Client</div>
                    <div class="fw-semibold">{{ $ticket->user->name }}</div>
                    <div class="small text-muted">{{ $ticket->user->email }}</div>
                </div>
            </div>
            @endif
            @if($ticket->voyage)
            <div class="col-sm-6 col-lg-3">
                <div class="p-3 bg-light rounded-3">
                    <div class="small text-muted mb-1"><i class="bi bi-map me-1"></i>Voyage</div>
                    <a href="{{ route('voyages.show', $ticket->voyage) }}" class="fw-semibold text-decoration-none">
                        {{ $ticket->voyage->ville_depart }} → {{ $ticket->voyage->ville_arrive }}
                    </a>
                    <div class="small text-muted">{{ $ticket->voyage->date?->format('d/m/Y') }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
