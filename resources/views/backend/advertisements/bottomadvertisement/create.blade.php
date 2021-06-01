@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('bottomindex')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add new Advertisement</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('savebottom')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="Link">Link / URL (URL to the advertisement website/ FB page, stc.)</label>
                                <input type="text" name="link" class="form-control {{($errors->any() && $errors->first('link')) ? 'is-invalid' : ''}}" value="{{old('link')}}">
                                @if($errors->any())
                                    <p class="invalid-feedback">{{$errors->first('link')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="Image">Select an Image: </label>
                                <input type="file" class="form-control {{($errors->any() && $errors->first('imagename')) ? 'is-invalid' : ''}}" value="{{old('imagename')}}"" name="imagename">
                                @if($errors->any())
                                    <p class="invalid-feedback">{{$errors->first('imagename')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="status" value="1">
                                <span style="font-weight:bold">Featured</span>
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
