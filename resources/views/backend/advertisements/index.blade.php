@extends('backend.layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success' )}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">
                            Advertisements
                        </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('advertisements.update', $advertisement->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#header" role="tab" aria-selected="true">Header</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#sidebar" role="tab" aria-selected="false">Sidebar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#bottom" role="tab" aria-selected="false">Bottom</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-5">
                                    <div class="tab-pane active" id="header">
                                        <div class="form-group">
                                            <div class="row mb-3">

                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="currentheaderimage">Existing Homepage Image</label>
                                                </div>

                                                <div class="col-md-8">
                                                    <img src="{{Storage::disk('uploads')->url($advertisement->homepage_header_image)}}" style='max-height: 70px; width: 690px;'>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="homepage_header_image">Homepage Header Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" name="homepage_header_image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="homepage_header_url">Homepage Header URL</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="homepage_header_url" class="form-control" value="{{ $advertisement->homepage_header_url }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row mb-3 mt-5">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="currentheaderimage">Existing Singlepage Image</label>
                                                </div>

                                                <div class="col-md-8">
                                                    <img src="{{Storage::disk('uploads')->url($advertisement->singlepage_header_image)}}" style='max-height: 70px; width: 690px;'>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="singlepage_header_image">Singlepage Header Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" name="singlepage_header_image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="singlepage_header_url">Singlepage Header URL</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="singlepage_header_url" class="form-control" value="{{ $advertisement->singlepage_header_url }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="sidebar">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="homepage_sidebar_image">Homepage Sidebar Image</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="file" name="homepage_sidebar_image" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-3">
                                                            <label for="currentsidebarimage">Existing Singlepage Image</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <img src="{{Storage::disk('uploads')->url($advertisement->homepage_sidebar_image)}}" style='max-height: 200px; width: 200px;'>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-3">
                                                            <label for="homepage_sidebar_url">Homepage Sidebar URL</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="homepage_sidebar_url" class="form-control" value="{{ $advertisement->homepage_sidebar_url }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="singlepage_sidebar_image">Singlepage Sidebar Image</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="file" name="singlepage_sidebar_image" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-3">
                                                            <label for="currentsidebarimage">Existing Singlepage Image</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <img src="{{Storage::disk('uploads')->url($advertisement->singlepage_sidebar_image)}}" style='max-height: 200px; width: 200px;'>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-3">
                                                            <label for="singlepage_sidebar_url">Singlepage Sidebar URL</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="singlepage_sidebar_url" class="form-control" value="{{ $advertisement->singlepage_sidebar_url }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="bottom">
                                        <div class="form-group">
                                            <div class="row mb-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="currentbottomimage">Existing Homepage Image</label>
                                                </div>

                                                <div class="col-md-8">
                                                    <img src="{{Storage::disk('uploads')->url($advertisement->homepage_bottom_image)}}" style='max-height: 350px; width: 850px;'>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="homepage_bottom_image">Homepage Bottom Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" name="homepage_bottom_image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="homepage_bottom_url">Homepage Bottom URL</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="homepage_bottom_url" class="form-control" value="{{ $advertisement->homepage_bottom_url }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row mb-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="currentbottomimage">Existing Singlepage Image</label>
                                                </div>

                                                <div class="col-md-8">
                                                    <img src="{{Storage::disk('uploads')->url($advertisement->singlepage_bottom_image)}}" style='max-height: 350px; width: 850px;'>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="singlepage_bottom_image">Singlepage Bottom Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" name="singlepage_bottom_image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <label for="singlepage_bottom_url">Singlepage Bottom URL</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="singlepage_bottom_url" class="form-control" value="{{ $advertisement->singlepage_bottom_url }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-1">
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


