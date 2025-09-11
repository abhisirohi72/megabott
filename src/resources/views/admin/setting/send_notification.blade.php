@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.setting.send_mail_notification')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Notification Subject<sup class="text-danger">*</sup></label>
                                <input type="text" name="notification_subject" id="notification_subject" class="form-control" required="">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Notification<sup class="text-danger">*</sup></label>
                                <input type="text" name="notification" id="notification" class="form-control" required="">
                            </div>
                        </div>
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


