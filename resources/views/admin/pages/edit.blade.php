@extends('admin.layout.dashboard')
@section('title')
Admin Edit Url
@endsection
@section('body')
<div class="preloader"></div>
<main id="main" class="main">
    <div id="head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="/post_edit_record" id="post_edit_record" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title_edit" name="title_edit" value="{{ $val[0]->title }}">
                            @error('title_edit')
                            <div class="error text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description_edit" name="description_edit" value="{{ $val[0]->description }}">
                            @error('description_edit')
                            <div class="error text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" id="url_edit" name="url_edit" value="{{ $val[0]->url }}">
                            @error('url_edit')
                            <div class="error text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="formFile" class="form-label">Video Upload</label>
                            <input class="form-control" type="file" id="file" name="file"  value="{{ $val[0]->file }}">
                            @error('file')
                            <div class="error text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" id="upload" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection
