@extends('layouts.user')
@section('content')
    <div class="main-content" data-simplebar>
        <h3 class="page-title">{{ $setTitle }} </h3>
        <div class="i-card-sm mt-2">
            <div class="row g-3">
                <h6 class="mb-2">Liverage details</h6>
                {{-- @foreach ($investmentUserRewards as $investmentUserReward) --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
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
                    </style>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Amount</th>
                                <th>Time Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($liverage_details as $liverage_detail)
                                <tr>
                                    <td>{{ $liverage_detail->name }}</td>
                                    <td><img src="{{ displayImage($liverage_detail->image) }}"
                                            style="width: 100px;height:100px;"></td>
                                    <td>{{ $liverage_detail->amount }}</td>
                                    <td>{{ $liverage_detail->time_duration }}</td>
                                    <td>
                                        @if ($liverage_detail->status == '1')
                                            active
                                        @else
                                            Unactive
                                        @endif
                                        @if($duration!="")
                                            <div id="countdown">00d 00h 00m 00s</div>
                                        @endif    
                                    </td>
                                    <td>
                                        @if (!$isActiveLiverage && ($total_algo < 15))
                                            <a href="{{ route('user.purchase_liverage', ['id' => $liverage_detail->id]) }}" onclick="this.style.display='none';"
                                                class="btn btn-sm btn-primary">Apply Now</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endsection

@push('script-push')
    <script>
        $(document).ready(function() {
            // Set your future date (YYYY-MM-DD HH:MM:SS)
            let futureDate = new Date("{{ $duration }}").getTime();

            function updateCountdown() {
                let now = new Date().getTime();
                let timeLeft = futureDate - now;

                if (timeLeft <= 0) {
                    $("#countdown").html("00d 00h 00m 00s");
                    clearInterval(timer);
                    return;
                }

                let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                $("#countdown").html(`${days}d ${hours}h ${minutes}m ${seconds}s`);
            }

            // Update every second
            let timer = setInterval(updateCountdown, 1000);

            // Initial call to avoid 1-sec delay
            updateCountdown();
        });
    </script>
@endpush
