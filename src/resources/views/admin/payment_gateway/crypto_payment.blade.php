@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__($setTitle)}}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.crypto.payment.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-wrapper">
                            <div class="row mb-3 g-3">
                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Logo 
                                        @if(!empty($prev_details))
                                            <sup class="text--danger">*</sup>
                                        @endif    
                                    </label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                    @if(!empty($prev_details))
                                        <img src="{{ displayImage($prev_details->logo) }}" style="width: 100px; height:100px;" class="mt-2">
                                    @endif    
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">QR Code Image 
                                        @if(!empty($prev_details))
                                            <sup class="text--danger">*</sup>
                                        @endif
                                    </label>
                                    <input type="file" name="qr_code" id="qr_code" class="form-control">
                                    @if(!empty($prev_details))
                                        <img src="{{ displayImage($prev_details->qr_code) }}" style="width: 100px; height:100px;" class="mt-2">
                                    @endif
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Crypto Address 
                                        @if(!empty($prev_details))
                                            <sup class="text--danger">*</sup>
                                        @endif
                                    </label>
                                    <input type="text" name="crypto_address" id="crypto_address" class="form-control" placeholder="crypto_address" value="{{ !empty($prev_details) ? $prev_details->crypto_address :''}}">
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Network 
                                        @if(!empty($prev_details))
                                            <sup class="text--danger">*</sup>
                                        @endif
                                    </label>
                                    <input type="text" name="network" id="network" class="form-control" placeholder="network" value="{{ !empty($prev_details) ? $prev_details->network :''}}">
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="name" class="form-label">Status 
                                        @if(!empty($prev_details))
                                            <sup class="text--danger">*</sup>
                                        @endif
                                    </label>
                                    <select class="form-control" name="status">
                                        <option value="">Please Select</option>
                                        <option value="1" {{ (!empty($prev_details) && $prev_details->status==1) ? 'selected="selected"' :''}}>Active</option>
                                        <option value="0" {{ (!empty($prev_details) && $prev_details->status==0) ? 'selected="selected"' :''}}>In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(!empty($prev_details))
                            <input type="hidden" name="edit_id" value="{{ $prev_details->id }}">
                        @endif
                        <button type="submit" class="i-btn btn--primary btn--md text--white"> {{ __('admin.button.save')}}</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>QR Code</th>
                                <th>Crypto Address</th>
                                <th>Network</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $key=>$detail)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ displayImage($detail->logo) }}" style="width:100px; height:100px;"></td>
                                <td><img src="{{ displayImage($detail->qr_code) }}" style="width:100px; height:100px;"></td></td>
                                <td>{{ $detail->crypto_address }}</td>
                                <td>{{ $detail->network }}</td>
                                <td>{{ $status = $detail->status == 1 ? 'Active' : 'Inactive';  }}</td>
                                <td>
                                    <a href="{{route('admin.crypto.payment.edit', $detail->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{route('admin.crypto.payment.delete', $detail->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
