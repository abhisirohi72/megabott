@extends('layouts.user')
@section('content')
    <div class="main-content" data-simplebar>
        <div class="row">
            <div class="col-lg-12">
                <div class="i-card-sm mb-4">
                    <div class="card-header">
                        <h4 class="title">{{ __($setTitle) }}</h4>
                    </div>

                    <div class="table-container">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Pair') }}</th>
                                    <th scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Market Cap') }}</th>
                                    <th scope="col">{{ __('Daily High') }}</th>
                                    <th scope="col">{{ __('Daily Low') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cryptoCurrency as $key => $crypto)
                                <tr>
                                    <td data-label="{{ __('Pair') }}">
                                        <div class="name d-flex align-items-center justify-content-md-start justify-content-end gap-lg-3 gap-2">
                                            <div class="icon">
                                                <img src="{{ $crypto->file }}" class="avatar--sm" alt="{{ __('Crypto-Image') }}">
                                            </div>
                                            <div class="content">
                                                <h6 class="fs-14">{{ $crypto->pair }}</h6>
                                                <span class="fs-13 text--light">{{ $crypto->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="{{ __('Price') }}">
                                        ${{ getArrayValue($crypto->meta, 'current_price') }}
                                    </td>
                                    <td data-label="{{ __('Market Cap') }}">
                                        {{ getArrayValue($crypto->meta, 'market_cap') }}
                                    </td>
                                    <td data-label="{{ __('Daily High') }}">
                                        {{ getArrayValue($crypto->meta, 'high_24h') }} %
                                    </td>
                                    <td data-label="{{ __('Daily Low') }}">
                                        {{ getArrayValue($crypto->meta, 'low_24h') }} %
                                    </td>
                                    <td data-label="{{ __('Action') }}">
                                        @if (getArrayValue($setting->system_configuration, 'binary_trade.value') == \App\Enums\Status::ACTIVE->value)
                                            <a href="{{ route('user.trade.binary', $crypto->crypto_id) }}" class="i-btn btn--sm btn--primary capsuled">{{ __('Trade') }}</a>
                                        @endif
                                        @if (getArrayValue($setting->system_configuration, 'practice_trade.value') == \App\Enums\Status::ACTIVE->value)
                                            <a href="{{ route('user.trade.practice', $crypto->crypto_id) }}" class="i-btn btn--sm btn--primary-outline capsuled">{{ __('Practice') }}</a>
                                        @endif
                                        @if (getArrayValue($setting->system_configuration, 'binary_trade.value') != \App\Enums\Status::ACTIVE->value && getArrayValue($setting->system_configuration, 'practice_trade.value') != \App\Enums\Status::ACTIVE->value)
                                            <span>{{ __('N/A') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $cryptoCurrency->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100% !important;
            height: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 500px;
            /* Ensures modal doesn't get too large */
            text-align: center;
            position: relative;
            border-radius: 10px;
            /* top: -80px; */
        }
        
        @media (max-width: 1024px) {
            .modal-content {
                background-color: white;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 50%;
                max-width: 500px;
                /* Ensures modal doesn't get too large */
                text-align: center;
                position: relative;
                border-radius: 10px;
                /* top: -80px; */
            }
        }

        @media (max-width: 768px) {
            .modal-content {
                background-color: white;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 50%;
                max-width: 500px;
                /* Ensures modal doesn't get too large */
                text-align: center;
                position: relative;
                border-radius: 10px;
                /* top: -80px; */
            }
        }

        @media (max-width: 480px) {
            .modal-content {
                background-color: white;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
                /* Ensures modal doesn't get too large */
                text-align: center;
                position: relative;
                border-radius: 10px;
                top: 110px;
            }
        }

        .close {
            position: absolute;
            top: -7px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
        }

        .modal-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 8px;
            background-size: contain;
            background-position-x: center;
        }
        .card {
            background: linear-gradient(to bottom, #f8d47d, #e6b34a);
            width: 100%;
            /* max-width: 350px; */
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            position: relative;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            overflow: visible; /* Ensure the image is not cut */
        }
        .image-container {
            position: absolute;
            top: -60px; /* Move the image up more */
            left: 50%;
            transform: translateX(-50%);
            width: 120px;  /* Adjust width */
            height: 120px; /* Adjust height */
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .badge {
            margin-top: 50px; /* Adjusted to prevent overlap */
            background: #f7c14a;
            padding: 12px 20px;
            border-radius: 30px;
            font-weight: bold;
            color: #fff;
            font-size: 18px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }
        .lottery {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .lottery span {
            background: green;
            color: white;
            padding: 8px 14px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .bonus {
            font-size: 28px;
            font-weight: bold;
            color: #222;
            margin: 10px 0;
        }
        .period {
            font-size: 14px;
            color: #444;
        }
        .auto-close {
            font-size: 12px;
            margin-top: 10px;
            color: #888;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        /* Responsive */
        @media (max-width: 400px) {
            .card {
                width: 95%;
            }
            .lottery span {
                font-size: 12px;
                padding: 6px 10px;
            }
            .bonus {
                font-size: 24px;
            }
            .image-container {
                width: 100px;
                height: 100px;
                top: -50px;
            }
        }
    </style>

    <!-- Modal Structure -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="card">
                <div class="image-container">
                    <img src="http://dhaliwalenterprises.com/megabott/assets/files/Wf7UTyXmO6xFKz2m.png" alt="Trophy">
                </div>
                <div class="badge">🚀 Congratulations</div>
                
                <h3>Algo Trade Income</h3>
                <div class="lottery">
                    <span style="background: green;">High</span>
                    <span style="background: #007bff;">Success</span>
                </div>
                <p class="bonus">Today Income: ${{ $get_user_today_algo }}</p>
                <p class="auto-close" style="font-size: 20px;font-weight: bold;">Total Algo Income: ⏳ {{ $total_algo }}</p>
                <p class="period">@php echo date('Y-m-d H:i:s') @endphp</p>
                
            </div>
        </div>
    </div>
@endsection

@push('script-push')
    <script>
        // Open the modal on page load
        $("#myModal").fadeIn();

        // Close the modal when clicking the close button
        $(".close").click(function() {
            $("#myModal").fadeOut();
        });

        // Close the modal when clicking outside the content
        $(window).click(function(event) {
            if ($(event.target).is("#myModal")) {
                $("#myModal").fadeOut();
            }
        });
    </script>
@endpush


