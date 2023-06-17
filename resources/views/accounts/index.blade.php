@extends('layouts.main')
@section('content')
    <div class="main-content">
        @include('navs.main-nav')
        @include('navs.page-nav', [
            'modalLinks' => [
                ['name' => 'Create Account', 'modalId' => 'createAccountModal'],
                ['name' => 'Create Deposit', 'modalId' => 'createDepositModal'],
            ]
        ])
        <div class="container-fluid">
            @include('partials.title', ['title' => 'Accounts'])
            <livewire:accounts-index/>
        </div>
    </div>
@endsection
