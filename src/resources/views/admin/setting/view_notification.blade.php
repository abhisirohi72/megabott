@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body" style="overflow: auto;">
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }

                        th,
                        td {
                            border: 1px solid #ddd;
                            padding: 10px;
                            text-align: left;
                        }

                        th {
                            background-color: #f4f4f4;
                        }

                        tr:hover {
                            background-color: #f1f1f1;
                        }
                    </style>
                    <table>
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter=1; @endphp
                            @foreach($details as $detail)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $detail->name }}</td>
                                <td>
                                    <img src="{{ displayImage($detail->image) }}" alt="" style="width: 100px; height:100px;">
                                </td>
                                <td>{{ $detail->description }}</td>
                                <td>
                                    <a href="{{ route('admin.setting.edit_notification', ['id'=>$detail->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('admin.setting.delete_notification', ['id'=>$detail->id ]) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @php $counter++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script-push')
    <script>
        "use strict";
        $(document).ready(function() {

        });
    </script>
@endpush
