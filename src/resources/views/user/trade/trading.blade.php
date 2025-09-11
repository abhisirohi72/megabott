@extends('layouts.auth')
@section('content')
    <main>
        <div class="trading-section pt-5 pb-110">
            <div class="container i-container">
                <div class="row g-4">
                    <div class="col-xl-9">
                        <div class="market-graph">
                            <div class="mb-5">
                                @include('user.partials.trade.trading-view')
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        @include('user.partials.trade.binary-trade')
                    </div>
                    <div class="col-xl-12">
                    @include('user.partials.trade.trade-log')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script-push')
    <script>
        'use strict';
        $(document).ready(function() {
            $("#amount").on('keyup', function() {
                const inputAmount = parseFloat($(this).val());
                const commissionPercentage = {{ getArrayValue($setting->commissions_charge, 'binary_trade_commissions', 0) }};

                if (isNaN(inputAmount)) {
                    $("#profit_amount").text('+' + 0.00);
                    return;
                }

                const profit = (commissionPercentage / 100) * inputAmount;
                const withProfitAmount = parseFloat(inputAmount) + parseFloat(profit);

                $("#profit_amount").text('+' + withProfitAmount.toFixed(2));
            });

            $("#switchButton").change(function() {
                var status = $(this).is(":checked") ? 1 : 0; // Get switch state (1 = checked, 0 = unchecked)

                $.ajax({
                    url: "{{ route('user.trade.update-switch-status') }}",  // Your backend route
                    type: "POST",
                    data: {
                        status: status,
                        _token: "{{ csrf_token() }}" // CSRF token for security in Laravel
                    },
                    success: function(response) {
                        if (response==1) {
                            alert("Successfull Updated!!!");
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong!");
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush






