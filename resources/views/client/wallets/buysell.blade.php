@extends('client.layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Compra/Venda Carteira') }}
</h2>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <livewire:client.buy-sell-wallet>
        </div>
    </div>
</div>
@endsection

