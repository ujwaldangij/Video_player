@extends('admin.layout.dashboard')
@section('title')
Admin Emart
@endsection
@section('body')
<div class="preloader"></div>
<main id="main" class="main">

    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <h5 class="card-title text-start">Recent Video</h5>
                <h5 class="card-title text-end">
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#add_record">
                        Add
                    </button>
                </h5>

                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiitle</th>
                            <th scope="col">Description</th>
                            <th scope="col">Url</th>
                            <th scope="col">View</th>
                            <th scope="col">Download</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($data_found)
                        @foreach ($data_found as $val)
                        <tr>
                            <th scope="row"><a href="#">{{ $val->id }}</a></th>
                            <td>{{ $val->title }}</td>
                            <td>{{ $val->description }}</td>
                            <td><a href="{{ route('event', $val->url) }}" target="_Blank" class="text-primary">{{ $val->url }}</a></td>
                            <td>{{ $val->view }}</td>
                            <td>{{ $val->download }}</td>
                            <td>

                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit_modal">
                                    <a href="{{ route('edit', $val->id) }}" class="text-white"><i class="bi bi-pencil-square"></i></a>
                                </button>
                               
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                     <a href="{{ route('delete', $val->id) }}" class="text-white"><i class="bi bi-archive"></i></a>
                                    
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>

            </div>

        </div>
    </div><!-- End Recent Sales -->
    <!-- Modal add -->
    <div class="modal fade" id="add_record" tabindex="-1" aria-labelledby="add_record" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_record1">Add Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/post_add_record" id="post_add_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div id="error_title" class="form-text text-danger"></div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                            <div id="error_description" class="form-text text-danger"></div>
                        </div>
                        <div class="mb-4">
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" id="url" name="url">
                            <div id="error_url" class="form-text text-danger"></div>
                        </div>
                        <div class="mb-4">
                            <label for="formFile" class="form-label">Video Upload</label>
                            <input class="form-control" type="file" id="file" name="file">
                            <div id="error_file" class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="upload">Upload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end add modal --}}

</main><!-- End #main -->
<script src="{{ asset('asset/admin/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('asset/admin/js/post_add_record.js') }}"></script>
@endsection
