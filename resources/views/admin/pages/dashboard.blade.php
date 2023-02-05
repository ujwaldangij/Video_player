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
                            <th scope="col" hidden>video</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table">

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
                        <div class="mb-2">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-2">
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <div class="mb-2">
                            <label for="formFile" class="form-label">Video Upload</label>
                            <input class="form-control" type="file" id="file" name="file">
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

    {{-- edit modal --}}
    <!-- Modal add -->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="add_record" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_record1">Edit Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/post_record_edit" id="post_record_edit" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="Title" class="form-label">Title</label>
                            <input type="hidden" class="form-control" id="edit_modal_id" name="edit_modal_id">
                            <input type="text" class="form-control" id="edit_modal_title" name="edit_modal_title">
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit_modal_description" name="edit_modal_description">
                        </div>
                        <div class="mb-2">
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" id="edit_modal_url" name="edit_modal_url">
                        </div>
                        <div class="mb-2">
                            <label for="formFile" class="form-label">Old Video</label>
                            <input class="form-control" type="hidden" id="edit_modal_old_video" name="edit_modal_old_video">
                            <div class="embed-responsive 
                                embed-responsive-21by9">
                                <video src="" id="old_frame"></video>
                            </div>
                        </div>
                        <div class="">
                            <label for="formFile" class="form-label">New Video</label>
                            <input class="form-control" type="file" id="edit_modal_file" name="edit_modal_file">
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
    {{-- end edit modal --}}
</main><!-- End #main -->
<script src="{{ asset('asset/admin/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('asset/admin/js/curd.js') }}" type="module"></script>
@endsection
