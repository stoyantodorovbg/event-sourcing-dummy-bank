@extends('layouts.main')
@section('content')
    <div class="main-content">
        @include('navs.main-nav')
    </div>
    <div class="container-fluid">
        @include('partials.title', ['title' => 'EVENT SOURCING DUMMY BANK'])
    </div>
@endsection
