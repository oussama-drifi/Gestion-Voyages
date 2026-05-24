@extends('layouts.app')
@section('title', $agence->nom)

@section('content')
<a href="{{ route('agences.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 p-3 bg-success bg-opacity-10">
                <i class="bi bi-shop-window fs-2 text-success"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0">{{ $agence->nom }}</h2>
                @if($agence->societe)
                    <a href="{{ route('societes.show', $agence->societe) }}" class="text-muted text-decoration-none small">
                        <i class="bi bi-building me-1"></i>{{ $agence->societe->nom }}
                    </a>
                @endif
            </div>
        </div>

        <div class="row g-3">
            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2 p-3 bg-light rounded-3">
                    <i class="bi bi-pin-map text-success fs-5"></i>
                    <div>
                        <div class="small text-muted">Ville</div>
                        <div class="fw-semibold">{{ $agence->ville }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2 p-3 bg-light rounded-3">
                    <i class="bi bi-signpost text-success fs-5"></i>
                    <div>
                        <div class="small text-muted">Adresse</div>
                        <div class="fw-semibold">{{ $agence->adresse }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
