@extends('client.layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Carteira') }}
</h2>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:p-6 lg:p-8">
            <livewire:client.update-wallet>
        </div>
    </div>
</div>
@endsection

