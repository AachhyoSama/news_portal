@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('permission.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add new Permission</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('permission.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Permission">Permission</label>
                                <input type="text" name="permission" class="form-control {{($errors->any() && $errors->first('permission')) ? 'is-invalid' : ''}}" value="{{old('permission')}}">
                                @if($errors->any())
                                    <p class="invalid-feedback">{{$errors->first('permission')}}</p>
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
