@extends('layouts.client')
@section('title', $voyage->ville_depart.' → '.$voyage->ville_arrive)

@section('content')
<a href="{{ route('client.voyages.index') }}" class="btn btn-sm btn-outline-secondary mb-4">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

<div class="row g-4">
    {{-- Left: Details + Seat map --}}
    <div class="col-lg-8">

        {{-- Header card --}}
        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">{{ $voyage->ville_depart }} <i class="bi bi-arrow-right text-primary"></i> {{ $voyage->ville_arrive }}</h2>
                        <span class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $voyage->date?->format('d/m/Y') }}</span>
                    </div>
                    <div class="fs-3 fw-bold text-primary">{{ number_format($voyage->prix, 2) }} MAD</div>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-sm-3">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <i class="bi bi-clock text-primary d-block mb-1 fs-5"></i>
                            <div class="small text-muted">Départ</div>
                            <div class="fw-semibold">{{ $voyage->heure_depart }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <i class="bi bi-clock-history text-primary d-block mb-1 fs-5"></i>
                            <div class="small text-muted">Arrivée</div>
                            <div class="fw-semibold">{{ $voyage->heure_arrive }}</div>
                        </div>
                    </div>
                    @if($voyage->bus)
                    <div class="col-6 col-sm-3">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <i class="bi bi-bus-front text-warning d-block mb-1 fs-5"></i>
                            <div class="small text-muted">Bus</div>
                            <div class="fw-semibold">{{ $voyage->bus->modele }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="p-3 bg-light rounded-3 text-center">
                            @php $comfortColors = ['basique'=>'secondary','bon'=>'primary','comfortable'=>'success']; @endphp
                            <i class="bi bi-star text-{{ $comfortColors[$voyage->bus->comfort] ?? 'secondary' }} d-block mb-1 fs-5"></i>
                            <div class="small text-muted">Confort</div>
                            <span class="badge bg-{{ $comfortColors[$voyage->bus->comfort] ?? 'secondary' }}">{{ ucfirst($voyage->bus->comfort) }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                @if($voyage->bus || $voyage->agenceDepart || $voyage->agenceArrive)
                <hr>
                <div class="d-flex flex-wrap gap-3 text-muted small">
                    @if($voyage->bus?->wifi)
                        <span><i class="bi bi-wifi text-info me-1"></i>WiFi disponible</span>
                    @endif
                    @if($voyage->bus?->societe)
                        <span><i class="bi bi-building me-1"></i>{{ $voyage->bus->societe->nom }}</span>
                    @endif
                    @if($voyage->agenceDepart)
                        <span><i class="bi bi-shop me-1"></i>Départ : {{ $voyage->agenceDepart->nom }}, {{ $voyage->agenceDepart->ville }}</span>
                    @endif
                    @if($voyage->agenceArrive)
                        <span><i class="bi bi-shop me-1"></i>Arrivée : {{ $voyage->agenceArrive->nom }}, {{ $voyage->agenceArrive->ville }}</span>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Seat map --}}
        @if($voyage->bus)
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1"><i class="bi bi-grid-3x3-gap me-2 text-primary"></i>Choisir une place</h5>
                <div class="d-flex gap-3 mb-4 text-muted small">
                    <span><span class="d-inline-block rounded me-1" style="width:14px;height:14px;background:#198754"></span>Disponible</span>
                    <span><span class="d-inline-block rounded me-1" style="width:14px;height:14px;background:#ffc107"></span>Réservée</span>
                    <span><span class="d-inline-block rounded me-1" style="width:14px;height:14px;background:#0d6efd"></span>Sélectionnée</span>
                </div>

                <form action="{{ route('client.tickets.store', $voyage) }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="numero_place" id="selectedSeat">

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @for($i = 1; $i <= $voyage->bus->totale_places; $i++)
                            @php $taken = in_array($i, $bookedSeats); @endphp
                            <button type="button"
                                class="seat-btn {{ $taken ? 'seat-taken' : 'seat-available' }}"
                                {{ $taken ? 'disabled' : '' }}
                                onclick="selectSeat({{ $i }}, this)">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>

                    <div id="confirmSection" class="d-none">
                        <div class="alert alert-primary d-flex align-items-center gap-2 py-2">
                            <i class="bi bi-person-seat-fill"></i>
                            Place <strong id="confirmSeatLabel"></strong> sélectionnée — {{ number_format($voyage->prix, 2) }} MAD
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Confirmer la réservation
                        </button>
                        <button type="button" class="btn btn-outline-secondary ms-2" onclick="clearSeat()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>

    {{-- Right: Timeline --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-signpost-split me-2 text-primary"></i>
                    Itinéraire
                    @if($root->voyage_id !== $voyage->voyage_id)
                        <span class="text-muted fw-normal small d-block mt-1">{{ $root->ville_depart }} → {{ $root->ville_arrive }}</span>
                    @endif
                </h5>

                @foreach($stops as $i => $stop)
                <div class="d-flex gap-3 {{ !$loop->last ? 'mb-0' : '' }}">
                    <div class="d-flex flex-column align-items-center">
                        <div class="timeline-dot {{ $stop['is_highlight'] ? 'highlight' : '' }}"></div>
                        @if(!$loop->last)
                            <div style="width:3px;flex:1;min-height:32px;background:{{ $stop['is_highlight'] ? '#0d6efd' : '#dee2e6' }};margin:2px 0"></div>
                        @endif
                    </div>
                    <div class="pb-3">
                        <div class="fw-{{ $stop['is_highlight'] ? 'bold' : 'normal' }} {{ $stop['is_highlight'] ? 'text-primary' : 'text-dark' }}">
                            {{ $stop['ville'] }}
                        </div>
                        <div class="text-muted small">{{ $stop['heure'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function selectSeat(num, btn) {
    document.querySelectorAll('.seat-btn.seat-selected').forEach(b => {
        b.classList.remove('seat-selected');
        b.classList.add('seat-available');
    });
    btn.classList.remove('seat-available');
    btn.classList.add('seat-selected');
    document.getElementById('selectedSeat').value = num;
    document.getElementById('confirmSeatLabel').textContent = num;
    document.getElementById('confirmSection').classList.remove('d-none');
}

function clearSeat() {
    document.querySelectorAll('.seat-btn.seat-selected').forEach(b => {
        b.classList.remove('seat-selected');
        b.classList.add('seat-available');
    });
    document.getElementById('selectedSeat').value = '';
    document.getElementById('confirmSection').classList.add('d-none');
}
</script>
@endpush
