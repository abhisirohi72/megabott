@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.binary.liverage.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Leverage Name <sup class="text-danger">*</sup></label>
                                <input type="text" name="liverage_name" id="liverage_name" placeholder="Enter Liverage Name" class="form-control" required="">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Leverage Image <sup class="text-danger">*</sup></label>
                                <input type="file" name="liverage_image" id="liverage_image" placeholder="Enter Liverage image" class="form-control" required="">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Amount<sup class="text-danger">*</sup></label>
                                <input type="text" name="amount" id="amount" placeholder="89.9" class="form-control" required="">
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Time Duration<sup class="text-danger">*</sup></label>
                                <input type="text" name="time_duration" id="time_duration" placeholder="how many days" class="form-control" required="">
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


