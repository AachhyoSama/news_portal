@extends('backend.layouts.app')

@push('styles')
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <a href="{{route('news.index')}}" class="btn btn-danger mt-3">Back</a>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Add A News</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" name="title" class="form-control {{($errors->any() && $errors->first('title')) ? 'is-invalid' : ''}}" value="{{old('title')}}" placeholder="News Title">
                                        @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" name="author" class="form-control" placeholder="Author Name">
                                        @error('author')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Image">Select an image (News Header Image)</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Choose News Categories </label>
                                        <select class="form-control chosen-select" data-placeholder="Type category names..." multiple name="category[]">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Details">News Details</label>
                                <textarea name="details" id="description" class="form-control"></textarea>
                                @error('details')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="status" value="1" style="height: 15px; width: 15px;">
                                        <label for="Status">Status</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="featured" class="form-check-input" value="1" style="height: 15px; width: 15px;">
                                        <label for="Featured">Featured</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="trending" class="form-check-input" value="1" style="height: 15px; width: 15px;">
                                        <label for="trending">Trending Topic</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-5">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h2>SEO Info</h2>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seotitle">SEO Title</label>
                                        <input type="text" name="seotitle" class="form-control" value="{{old('seotitle')}}" placeholder="SEO Title">
                                        @error('seotitle')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">SEO Keywords (Tags)</label>
                                        <input type="text" class="form-control" name="tags" value="{{old('tags')}}" data-role="tagsinput">
                                        <p class="text-success">Note* :Seperate each one by comma.</p>
                                        @error('tags')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="seodescription">SEO Description</label>
                                    <textarea name="seodescription" class="form-control" cols="10" rows="10" placeholder="SEO Description here...">{{old('seodescription')}}</textarea>
                                    @error('seodescription')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">


        $(function () {
            $('#description').summernote({
                height: 300,
                placeholder: "News Details here..",
                callbacks: {
                    onImageUpload: function(files) {
                        console.log(files);
                        for(var i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    }
                }
            });

            $.upload = function (file) {

                let out = new FormData();
                out.append('file', file, file.name);
                console.log("outform is ",out);
                $.ajax({
                    method: 'POST',
                    url: '{{ route('news.store')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    data: out,
                    success: function (r) {
                        console.log(typeof r);
                        $('#description').summernote('insertImage', r.url);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };
            $("#description").summernote({
                callbacks : {
                    onMediaDelete : function ($target, $editable) {
                        console.log($target.attr('src'));   // get image url
                    }
                }
            });

            @foreach($images as $image)
                $('#description').summernote('insertImage', '{{Storage::disk('uploads')->url($image->images)}}');
            @endforeach
        });


</script>
{{-- <script type="text/javascript">
    $('#summernote1').summernote({
        height: 300,
        placeholder: "SEO Description..."
    });
</script> --}}
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
@endpush

