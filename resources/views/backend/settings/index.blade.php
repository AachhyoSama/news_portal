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
                            Settings
                        </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('settings.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab" aria-selected="true">Site Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" aria-selected="false">Social Media</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_3" role="tab" aria-selected="false">About Us</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_4" role="tab" aria-selected="false">Address</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-5">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="site address">Site Address</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="sitename" class="form-control" value="{{ $setting->sitename }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="siteimage">Select an Site Image</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" name="siteImage" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="currentimage">Current Site Image</label>
                                                    <img src="{{Storage::disk('uploads')->url($setting->siteImage)}}" style='max-width: 100px; width:200px;'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="sitelogo">Select a site logo</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" name="siteLogo" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="currentlogo">Current Site Logo</label>
                                                    <img src="{{Storage::disk('uploads')->url($setting->siteLogo)}}" style='max-width: 200px;'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="facebook">Facebook</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="linkedin">Linkedin</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="linkedin" class="form-control" value="{{ $setting->linkedin }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="youtube">Youtube</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="youtube" class="form-control" value="{{ $setting->youtube }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="instagram">Instagram</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab_3">
                                        <div class="form-group">
                                            <textarea name="aboutus" id="summernote">{{ $setting->aboutus }}</textarea>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab_4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="address">Address</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="address" class="form-control" value="{{$setting->address}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="phone">Phone No</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="phone" class="form-control" value="{{$setting->phone}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="email" class="form-control" value="{{$setting->email}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
        });

        $('#summernote1').summernote({
            height: 300,
        });
</script>
@endpush
