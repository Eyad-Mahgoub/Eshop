@extends('layouts.admin')

@section('title')
Maps
@endsection

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <h4>Map Edit</h4>
        </div>
        <div class="card-body">
            <div id="map-div" class="w-100" style="height: 500px"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter Details</h1>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="">Name</label>
                    <input class="name form-control w-100 " type="text" name="name" id="markerName">
                </div>
                <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="">Description</label>
                    <input class="name form-control w-100 " type="text" name="description" id="markerDescription">
                </div>
            </div>
            <div class="modal-footer">
                <button id="modalCancel" type="button" class="btn btn-primary">Cancel</button>
                <button id="modalSave" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Details</h1>
            </div>
            <div class="modal-body">
                <input class="d-none" type="text" name="id" id="markerEditId">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="">Name</label>
                    <input class="name form-control w-100 " type="text" name="name" id="markerEditName">
                </div>
                <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="">Description</label>
                    <input class="name form-control w-100 " type="text" name="description" id="markerEditDescription">
                </div>
            </div>
            <div class="modal-footer">
                <button id="modalEditCancel" type="button" class="btn btn-primary">Cancel</button>
                <button id="modalEditSave" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center w-100 overlay-loading d-none">
    <div class="spinner-border overlay-loading-content" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('admin/js/services-web.min.js') }}"></script>
<script src="{{ asset('admin/js/maps-web.min.js') }}"></script>
<script src="{{ asset('admin/js/maps.js') }}"></script>
@endsection
