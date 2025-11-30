@extends('layouts.dashboard')
@section('title', 'My Modules')

@section('content')
<style>
    /* ===== Custom Styling ===== */

    .modules-header {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        padding: 32px;
        border-radius: 18px;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        position: relative;
    }

    .modules-header h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .modules-header p {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .modules-header .create-btn {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        background: #ffffff;
        color: #1d4ed8 !important;
        padding: 10px 18px;
        font-weight: 600;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(255,255,255,0.3);
        transition: 0.25s ease;
    }

    .modules-header .create-btn:hover {
        background: #f1f5ff;
        transform: translateY(-50%) scale(1.05);
    }

    /* ===== Cards ===== */

    .module-card {
        border: none;
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
        transition: 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .module-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .module-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 10px;
    }

    .module-category {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 18px;
    }

    .module-actions .btn {
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-edit {
        background: #1d4ed8;
        color: white;
    }

    .btn-edit:hover {
        background: #1e40af;
    }

    .btn-submodules {
        background: #e5e7eb;
        color: #1f2937;
    }

    .btn-submodules:hover {
        background: #d1d5db;
    }

    .module-actions {
        margin-top: auto;
        display: flex;
        gap: 10px;
    }

</style>

<div class="container py-4">

    {{-- Header --}}
    <div class="modules-header">
        <h3>My Modules</h3>
        <p>Manage your learning modules and update their content easily.</p>

        <a href="{{ route('dashboard.mentor.modules.create') }}" class="create-btn">
            <i class="fa fa-plus me-1"></i> Create Module
        </a>
    </div>

    {{-- Cards --}}
    <div class="row g-4">
        @foreach($modules as $mod)
            <div class="col-md-4">
                <div class="module-card">

                    <div>
                        <h5 class="module-title">{{ $mod->title }}</h5>
                        <p class="module-category">
                            Category: <strong>{{ $mod->category->name }}</strong>
                        </p>
                    </div>

                    <div class="module-actions">
                        <a href="{{ route('dashboard.mentor.modules.edit', $mod->id) }}" class="btn btn-edit">
                            Edit
                        </a>

                        <a href="{{ route('dashboard.mentor.submodules.index', $mod->id) }}" class="btn btn-submodules">
                            View Submodules
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
