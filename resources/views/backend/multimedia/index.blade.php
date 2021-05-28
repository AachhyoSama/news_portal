@extends('backend.layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('multimedia.create')}}" class="btn btn-success mt-3">Add Multimedia</a>
        <div class="row mt-3">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success' )}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">
                            Multimedia
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
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
          ajax: "{{ route('multimedia.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'title', name: 'title'},
              {data: 'link', name: 'link'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
</script>
@endpush

