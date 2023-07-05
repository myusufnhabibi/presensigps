@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Setting
                    </div>
                    <h2 class="page-title">
                        Lokasi Kantor
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-5">

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Update Lokasi</h4>
                        </div>
                        @php
                            $success = Session::get('success');
                            $danger = Session::get('danger');
                        @endphp
                        @if (Session::get('success'))
                            <div class="alert alert-success mt-2">
                                {{ $success }}
                            </div>
                        @endif
                        @if (Session::get('danger'))
                            <div class="alert alert-danger mt-2">
                                {{ $danger }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="/update" method="post">
                                @csrf
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-current-location" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0"></path>
                                            <path d="M12 2l0 2"></path>
                                            <path d="M12 20l0 2"></path>
                                            <path d="M20 12l2 0"></path>
                                            <path d="M2 12l2 0"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="{{ $lokasi->lokasi ?: '' }}" name="lokasi"
                                        class="form-control" placeholder="Lokasi">
                                </div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-layout-distribute-vertical" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 4l0 16"></path>
                                            <path d="M20 4l0 16"></path>
                                            <path
                                                d="M9 6m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input type="text" value="{{ $lokasi->radius ?: '' }}" name="radius"
                                        class="form-control" placeholder="Radius">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                            </path>
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
