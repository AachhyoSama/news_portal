@extends('backend.layouts.app')
@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('news.create')}}" class="btn btn-success mt-3">Add News</a>
        <div class="row mt-3">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success' )}}</div>
                @endif
                @if(session()->has('failure'))
                    <div class="alert alert-danger">{{ session('failure' )}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">
                            News
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Featured</th>
                                    <th>Is Trending</th>
                                    <th>View count</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('news.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'image', name: 'image'},
              {data: 'title', name: 'title'},
              {data: 'category', name: 'category'},
            //   {data: 'status', name: 'status'},
              {data: 'featured', name: 'featured'},
              {data: 'is_trending', name: 'is_trending'},
              {data: 'view_count', name: 'view_count'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
</script>
@endpush
