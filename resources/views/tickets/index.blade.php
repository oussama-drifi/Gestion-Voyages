@extends('layouts.app')
@section('title', 'Tickets')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <i class="bi bi-ticket-perforated fs-3 text-danger"></i>
    <h1 class="h3 fw-bold mb-0">Tickets</h1>
    <span class="badge bg-danger ms-1">{{ $tickets->count() }}</span>
</div>

@if($tickets->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Aucun ticket trouvé.</div>
@else
    <div class="row g-3">
        @foreach($tickets as $ticket)
        @php $isValid = $ticket->statut === 'validé'; @endphp
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('tickets.show', $ticket) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-ticket-perforated text-danger fs-5"></i>
                                <span class="fw-semibold text-dark">#{{ $ticket->ticket_id }}</span>
                            </div>
                            <span class="badge bg-{{ $isValid ? 'success' : 'danger' }}">
                                <i class="bi bi-{{ $isValid ? 'check-circle' : 'x-circle' }} me-1"></i>{{ ucfirst($ticket->statut) }}
                            </span>
                        </div>
                        @if($ticket->voyage)
                            <p class="text-muted small mb-1">
                                <i class="bi bi-map me-1"></i>{{ $ticket->voyage->ville_depart }} → {{ $ticket->voyage->ville_arrive }}
                            </p>
                        @endif
                        <div class="d-flex gap-3 text-muted small">
                            <span><i class="bi bi-person-seat me-1"></i>Place {{ $ticket->numero_place }}</span>
                            <span><i class="bi bi-cash me-1"></i>{{ number_format($ticket->prix, 2) }} MAD</span>
                        </div>
                    </div>
                    @if($ticket->user)
                    <div class="card-footer bg-transparent border-0">
                        <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $ticket->user->name }}</small>
                    </div>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
