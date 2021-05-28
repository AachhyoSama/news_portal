@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('user.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#details" role="tab" aria-selected="true">Edit Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#password" role="tab" aria-selected="false">Update Password</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane active" id="details">
                                    <h2>Edit User details</h2>
                                    <hr>
                                    <form action="{{route('user.update', $user->id)}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="Name">Name</label>
                                            <input type="text" name="name" class="form-control {{($errors->any() && $errors->first('name')) ? 'is-invalid' : ''}}" value="{{old('name', $user->name)}}">
                                            @if($errors->any())
                                                <p class="invalid-feedback">{{$errors->first('name')}}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="text" name="email" class="form-control {{($errors->any() && $errors->first('email')) ? 'is-invalid' : ''}}" value="{{old('email',$user->email)}}">
                                            @if($errors->any())
                                                <p class="invalid-feedback">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="Role">Role</label>
                                            <select name="role" class="form-control">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ ($user->role_id == $role->id  ? 'selected' : '') }}>
                                                            {{old('role', $role->name)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" name="submitdetails" class="btn btn-success">Submit</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="password">
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h2>Edit User Password</h2>
                                            <hr>
                                            <form action="{{route('user.update', $user->id)}}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <div class="row">
                                                    <div class="col-6">

                                                        <div class="form-group">
                                                            <label for="OldPassword">Old Password</label>
                                                            <input type="password" name="oldpassword" class="form-control {{($errors->any() && $errors->first('oldpassword')) ? 'is-invalid' : ''}}">
                                                            @if($errors->any())
                                                                <p class="invalid-feedback">{{$errors->first('oldpassword')}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Password">New Password</label>
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
                                                </div>

                                                <button type="submit" name="submitpassword" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
