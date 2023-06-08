@extends('layouts.main')
@section('content')
    <div class="main-content">
        @include('navs.main-nav')
        <div class="container-fluid">
            @include('partials.title', ['title' => 'Credits'])
            <livewire:credits-index/>
        </div>
    </div>
@endsection
