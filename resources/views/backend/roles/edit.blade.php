@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('roles.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Role</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('roles.update', $role->id)}}" method="POST" class="bg-light p-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Role Name: </label>
                                <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="Enter Role Name">
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="permission">Permissions </label><br>
                                @foreach ($permissions as $permission)
                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                    @if(in_array($permission->id, $selectedperm))
                                        {{"checked"}}
                                    @else
                                        {{""}}
                                    @endif> {{$permission->permission}} <br>
                                @endforeach
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
@push('scripts')

@endpush
