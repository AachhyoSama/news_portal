@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('headerindex')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Advertisement Info</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateheader', $header_advertisement->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="form-group">
                                <label for="Link">Link / URL (URL to the advertisement website/ FB page, stc.)</label>
                                <input type="text" name="link" class="form-control {{($errors->any() && $errors->first('link')) ? 'is-invalid' : ''}}" value="{{$header_advertisement->link}}">
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

                                <p class="text-success">Note:* Do not select new image if you want the previous image.</p>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="status" value="1"{{$header_advertisement->status == 1? "checked" : ""}}>
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
