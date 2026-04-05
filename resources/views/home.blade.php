@extends('layout.app')


@section('content')
<section class="hero-section bg-white">
    <div class="hero-container mx-auto px-4 py-10 lg:py-16 max-w-screen-xl">
        <div class="hero-inner grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div class="hero-copy">
                <p class="hero-eyebrow">Kebun Raya Daerah</p>
                <h1 class="hero-title">Kebun Raya Bundayati</h1>
                <p class="hero-subtitle"></p>
                <div class="hero-actions">
                    <button class="button--primary">Explore</button>
                </div>
            </div>
            <img class="" src="{{ asset('storage/images/header.png') }}" alt=""/>

        </div>
    </div>
</section>
<section class="bg-white py-1">
    
</section>
@endsection


