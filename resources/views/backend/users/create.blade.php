@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('user.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add new User</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('user.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="name" class="form-control {{($errors->any() && $errors->first('name')) ? 'is-invalid' : ''}}" value="{{old('name')}}">
                                @if($errors->any())
									<p class="invalid-feedback">{{$errors->first('name')}}</p>
								@endif
                            </div>

                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="text" name="email" class="form-control {{($errors->any() && $errors->first('email')) ? 'is-invalid' : ''}}" value="{{old('email')}}">
                                @if($errors->any())
									<p class="invalid-feedback">{{$errors->first('email')}}</p>
								@endif
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="password" class="form-control {{($errors->any() && $errors->first('password')) ? 'is-invalid' : ''}}">
                                        @if($errors->any())
                                            <p class="invalid-feedback">{{$errors->first('password')}}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="Confirm Password">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control {{($errors->any() && $errors->first('password_confirmation')) ? 'is-invalid' : ''}}">
                                        @if($errors->any())
                                            <p class="invalid-feedback">{{$errors->first('password_confirmation')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Role">Role</label>
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
