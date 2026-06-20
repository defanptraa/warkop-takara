@extends('layouts.app')

@section('header')
    <h2 class="text-3xl font-extrabold text-primary flex items-center gap-3">
        <i class="fas fa-receipt"></i> Daftar Semua Pesanan
    </h2>
@endsection

@section('content')
    <div class="max-w-screen-xl mx-auto py-10 px-6 bg-white rounded-3xl shadow-2xl space-y-10">
        @include('admin.order.orders', ['orders' => $orders])
    </div>
@endsection
