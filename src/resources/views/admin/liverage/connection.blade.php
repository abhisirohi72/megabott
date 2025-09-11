@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.binary.liverage.connection.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Users <sup class="text-danger">*</sup></label>
                                <select name="user" id="users" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="all">All Users</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Leverage Enabled <sup class="text-danger">*</sup></label><br>
                                <input type="radio" name="liverage_enabled" value="1" > Yes 
                                <input type="radio" name="liverage_enabled" value="0" > No
                            </div>
                        </div>
                        <button class="i-btn btn--primary btn--lg">{{ __('admin.button.save') }}</button>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>Leverage Enabled</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->liverage_enabled=="1")?"YES":"No" }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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


