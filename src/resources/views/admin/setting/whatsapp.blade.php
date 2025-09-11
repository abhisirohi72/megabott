@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.setting.update_whatsapp')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Token <sup class="text-danger">*</sup></label>
                                <input type="text" name="whatsapp_token" id="whatsapp_token" class="form-control" required="" value="{{ $details->whatsapp_token ?? ''}}">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">API URL<sup class="text-danger">*</sup></label>
                                <input type="text" name="whatsapp_api_url" id="whatsapp_api_url" class="form-control" required="" value="{{ $details->whatsapp_api_url  ?? ''}}">
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? '' }}">
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


