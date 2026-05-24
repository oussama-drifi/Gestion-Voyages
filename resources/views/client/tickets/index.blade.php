@extends('layouts.client')
@section('title', 'Mes tickets')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <i class="bi bi-ticket-perforated fs-3 text-primary"></i>
    <h1 class="h3 fw-bold mb-0">Mes tickets</h1>
    <span class="badge bg-primary ms-1">{{ $tickets->count() }}</span>
</div>

@if($tickets->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-ticket-perforated text-muted" style="font-size:3rem"></i>
        <p class="text-muted mt-3">Vous n'avez aucun ticket pour le moment.</p>
        <a href="{{ route('client.voyages.index') }}" class="btn btn-primary">
            <i class="bi bi-search me-1"></i>Rechercher un voyage
        </a>
    </div>
@else
    <div class="row g-3">
        @foreach($tickets as $ticket)
        @php $isValid = $ticket->statut === 'validé'; @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    {{-- Status + ticket id --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small fw-semibold">#{{ $ticket->ticket_id }}</span>
                        <span class="badge bg-{{ $isValid ? 'success' : 'danger' }}">
                            <i class="bi bi-{{ $isValid ? 'check-circle' : 'x-circle' }} me-1"></i>{{ ucfirst($ticket->statut) }}
                        </span>
                    </div>

                    {{-- Route --}}
                    @if($ticket->voyage)
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <div class="fw-bold text-dark">{{ $ticket->voyage->ville_depart }}</div>
                            <div class="text-muted small">{{ $ticket->voyage->heure_depart }}</div>
                        </div>
                        <i class="bi bi-arrow-right text-primary mx-2"></i>
                        <div class="text-end">
                            <div class="fw-bold text-dark">{{ $ticket->voyage->ville_arrive }}</div>
                            <div class="text-muted small">{{ $ticket->voyage->heure_arrive }}</div>
                        </div>
                    </div>
                    <div class="text-muted small mb-3">
                        <i class="bi bi-calendar3 me-1"></i>{{ $ticket->voyage->date?->format('d/m/Y') }}
                        @if($ticket->voyage->bus?->societe)
                            &nbsp;·&nbsp;<i class="bi bi-building me-1"></i>{{ $ticket->voyage->bus->societe->nom }}
                        @endif
                    </div>
                    @endif

                    {{-- Seat + price --}}
                    <div class="d-flex gap-3">
                        <div class="p-2 bg-light rounded-3 text-center flex-grow-1">
                            <div class="small text-muted">Place</div>
                            <div class="fw-bold">{{ $ticket->numero_place }}</div>
                        </div>
                        <div class="p-2 bg-light rounded-3 text-center flex-grow-1">
                            <div class="small text-muted">Prix</div>
                            <div class="fw-bold text-primary">{{ number_format($ticket->prix, 2) }} MAD</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
