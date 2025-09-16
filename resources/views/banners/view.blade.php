<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h2>Active Banners</h2> -->

    @if($banners->count())
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($banners as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $banner->image) }}" 
                     class="d-block w-100" 
                     alt="{{ $banner->alt_text ?? 'Banner' }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $banner->title }}</h5>
                    <p>{{ $banner->description }}</p>
                    @if($banner->link)
                        <a href="{{ $banner->link }}" class="btn btn-light">Visit</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

@else
        <p>No active banners found.</p>
    @endif
</div>
@endsection
