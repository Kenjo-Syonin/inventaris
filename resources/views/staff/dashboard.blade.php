@extends('layouts.app')

@section('title', 'Dashboard Staff')
@section('header', 'Dashboard Operator')

@section('content')
    <div class="alert alert-info">
        Selamat datang di panel operator. Anda dapat mengelola peminjaman barang di sini.
    </div>
    
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5>Status Peminjaman Hari Ini</h5>
            <p class="text-muted">Belum ada aktivitas peminjaman hari ini.</p>
        </div>
    </div>
@endsection