@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.setting.update_notification')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Name <sup class="text-danger">*</sup></label>
                                <input type="text" name="name" id="name" class="form-control" required="" value="{{ $details->name }}">
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Image <sup class="text-danger">*</sup></label>
                                <input type="file" name="image" id="image" class="form-control" >
                                <img src="{{ displayImage($details->image) }}" alt="" style="width: 100px; height:100px;">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Description<sup class="text-danger">*</sup></label>
                                <input type="text" name="desc" id="desc" class="form-control" required="" value="{{ $details->description }}">
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id }}">
                        <input type="hidden" name="old_img" id="old_img" value="{{ $details->image }}">
                        <button class="i-btn btn--primary btn--lg">{{ __('admin.button.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script-push')
    <script>
        "use strict";
        $(document).ready(function () {
            
        });
    </script>
@endpush


