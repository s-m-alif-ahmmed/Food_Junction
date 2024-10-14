@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <a href="{{ route('user.index') }}" class="card-link">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $verifiedUsers }}</h3>
                                <p class="text-muted fs-13 mb-0"> Users</p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
                                        <circle fill="#6E83B7" cx="256" cy="256" r="246" />
                                        <ellipse fill="#EDEFF1" cx="256" cy="356" rx="173.237"
                                            ry="100" />
                                        <circle fill="#EDEFF1" cx="256" cy="156" r="100" />
                                        <g>
                                            <path fill="#D3D3D3"
                                                d="m256 376 80.714-103.039C312.027 262.058 284.722 256 256 256s-56.027 6.058-80.714 16.961L256 376z" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
@endsection
