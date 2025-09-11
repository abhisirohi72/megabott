@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.binary.liverage.add_setting')}}" method="POST">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Is Liverage Automatic </label>
                                <input type="radio" name="liverage_setting" value="0" @if($details->liverage_setting==0) checked="checked" @endif>
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Is Liverage Manually </label>
                                <input type="radio" name="liverage_setting" value="1" @if($details->liverage_setting==1) checked="checked" @endif>
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


