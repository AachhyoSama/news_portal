@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('multimedia.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add new Multimedia</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('multimedia.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" name="title" class="form-control {{($errors->any() && $errors->first('title')) ? 'is-invalid' : ''}}" value="{{old('title')}}">
                                @if($errors->any())
                                    <p class="invalid-feedback">{{$errors->first('title')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="Link">Link</label>
                                <input type="text" name="link" class="form-control {{($errors->any() && $errors->first('link')) ? 'is-invalid' : ''}}" value="{{old('link')}}">
                                @if($errors->any())
                                    <p class="invalid-feedback">{{$errors->first('link')}}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
