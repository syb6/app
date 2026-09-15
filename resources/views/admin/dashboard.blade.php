@extends('layouts.app')

@section('title', 'Response Dashboard')

@section('content')
<div class="container py-3 py-md-5">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1">Responses 💌</h2>
            <p class="text-muted mb-0 small">Viewing all submitted questionnaire entries.</p>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="w-100 w-sm-auto">
            @csrf
            <button type="submit" class="btn btn-outline-danger rounded-pill px-4 w-100 w-sm-auto">Logout</button>
        </form>
    </div>

    @if($responses->isEmpty())
        <div class="cute-card p-4 p-md-5 text-center">
            <i class="fa-regular fa-folder-open display-4 text-muted mb-3"></i>
            <h5 class="fw-semibold">No responses submitted yet!</h5>
        </div>
    @else
        <div class="row g-3 g-md-4">
            @foreach($responses as $res)
                <div class="col-12">
                    <div class="cute-card p-3 p-md-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center border-bottom pb-3 mb-3 gap-2">
                            <h4 class="fw-bold text-danger mb-0">{{ $res->name }}</h4>
                            <span class="badge bg-light text-dark rounded-pill border px-3 py-2 small">
                                <i class="fa-regular fa-clock me-1"></i> {{ $res->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>

                        <div class="row g-2 g-md-3">
                            <div class="col-12 col-sm-6 col-md-4"><strong>Location:</strong> {{ $res->location }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($res->birthday)->format('M d, Y') }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Color:</strong> {{ $res->favorite_color }}</div>

                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Food:</strong> {{ $res->favorite_food }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Movie/Show:</strong> {{ $res->favorite_movie }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Song:</strong> {{ $res->favorite_song }}</div>

                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Place:</strong> {{ $res->favorite_place }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Favorite Snack:</strong> {{ $res->favorite_snack }}</div>
                            <div class="col-12 col-sm-6 col-md-4"><strong>Dream Destination:</strong> {{ $res->dream_destination }}</div>

                            <div class="col-12 mt-3">
                                <div class="bg-light p-3 rounded-4">
                                    <strong>Favorite Memory Together:</strong>
                                    <p class="mb-0 mt-1 text-muted">{{ $res->favorite_memory }}</p>
                                </div>
                            </div>

                            @if($res->anything_else)
                                <div class="col-12">
                                    <div class="p-3 rounded-4" style="background-color: #FFF0F5;">
                                        <strong>Anything Else:</strong>
                                        <p class="mb-0 mt-1 text-muted">{{ $res->anything_else }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $responses->links() }}
        </div>
    @endif
</div>
@endsection