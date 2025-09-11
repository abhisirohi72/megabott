@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 20px 0;
                            font-size: 18px;
                            text-align: left;
                        }

                        th,
                        td {
                            padding: 10px;
                            border: 1px solid #ddd;
                        }

                        th {
                            background-color: #f4f4f4;
                        }

                        tr:nth-child(even) {
                            background-color: #f9f9f9;
                        }
                        .dropdown-menu .dropdown-submenu {
            position: relative;
        }

        .dropdown-menu .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -5px;
            display: none;
            position: absolute;
        }

        .dropdown-menu .dropdown-submenu:hover .dropdown-menu {
            display: block;
        }
                    </style>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>Leverage Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($liverage_requests as $liverage_request)
                                    <tr>
                                        <td>{{ $liverage_request->user->email }}</td>
                                        <td>{{ $liverage_request->liverage->name ?? '' }}</td>
                                        <td>
                                            @if($liverage_request->status=="0")
                                                Pending
                                            @elseif($liverage_request->status=="1")
                                                Approved
                                            @elseif($liverage_request->status=="2")
                                                Rejected
                                            @endif    
                                        </td>
                                        <td>{{ $liverage_request->created_at }}</td>
                                        <td>
                                            @if($liverage_request->status=="0")
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #061ce2;">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('admin.binary.liverage.update', ['liverage_id'=>$liverage_request->liverage_id, 'user_id'=>$liverage_request->user->id, 'status'=>'1']) }}">Approved</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('admin.binary.liverage.update',[
                                                            'liverage_id'=>$liverage_request->liverage_id, 'user_id'=>$liverage_request->user->id, 'status'=>'2'
                                                        ]) }}">Reject</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                        
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
