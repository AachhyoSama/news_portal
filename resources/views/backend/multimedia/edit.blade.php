@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('multimedia.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Multimedia information</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('multimedia.update', $multimedia->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="Title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $multimedia->title)}}">
                            </div>

                            <div class="form-group">
                                <label for="Link">Link</label>
                            <input type="text" name="link" class="form-control" value="{{ old('link', $multimedia->link) }}">
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
