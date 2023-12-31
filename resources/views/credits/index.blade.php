@extends('layouts.main')
@section('content')
    <div class="main-content">
    @include('navs.main-nav')
    @include('navs.page-nav', [
        'modalLinks' => [
            ['name' => 'Create Credit', 'modalId' => 'createCreditModal'],
            ['name' => 'Create Deposit', 'modalId' => 'createDepositModal'],
        ]
    ])
    <div class="container-fluid">
        @include('partials.title', ['title' => 'Credits'])
        <livewire:credits-index/>
    </div>
</div>
@endsection
