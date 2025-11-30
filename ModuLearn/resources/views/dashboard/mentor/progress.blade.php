@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Progress Belajar Kamu</h3>

    @forelse($progressList as $item)
        @if(!empty($item['module']))
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="fw-bold">{{ $item['module']->title }}</h5>
                    <p class="text-muted">{{ $item['module']->description }}</p>

                    {{-- PROGRESS BAR --}}
                    <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar" 
                            role="progressbar" 
                            style="width: {{ $item['progress'] }}%;">
                            {{ $item['progress'] }}%
                        </div>
                    </div>

                    <small class="text-muted">
                        {{ $item['completed'] }} selesai dari {{ $item['total'] }} submodul
                    </small>

                </div>
            </div>
        @else
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <p class="text-danger">Module tidak ditemukan</p>
                </div>
            </div>
        @endif
    @empty
        <p class="text-muted">Belum ada progress modul.</p>
    @endforelse


</div>
@endsection
