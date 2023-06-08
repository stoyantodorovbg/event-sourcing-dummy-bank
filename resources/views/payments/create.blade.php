@extends('layouts.main')
@section('content')
    <div class="main-content">
        @include('navs.main-nav')
        <div class="container-fluid">
            @include('partials.title', ['title' => 'Create Payment'])
            <livewire:create-payment/>
        </div>
    </div>
@endsection
