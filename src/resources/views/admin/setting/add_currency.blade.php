@extends('admin.layouts.main')
@section('panel')
    <section>
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $setTitle }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.setting.save_currency')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-2">
                            <div class="admin-commission"></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="">Add USDT <sup class="text-danger">*</sup></label>
                                <input type="text" name="add_currency_name" id="add_currency_name" class="form-control" required="" value="1 USDT" readonly>
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label" for="">Add Currency<sup class="text-danger">*</sup></label>
                                <input type="text" name="currency" id="currency" placeholder="89.9 INR" class="form-control" required="">
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
            function calculateAdminGainLoss() {
                const referralCommissionInputs = $('.referral-commission-amount');
                const planAmountInput = $('#amount');
                const referralRewardInput = $('#referral-reward');

                let referralCommissionTotal = 0;
                referralCommissionInputs.each(function calculateReferralCommissionTotal() {
                    if ($(this).val() !== '') {
                        referralCommissionTotal += +$(this).val();
                    }
                });

                const planAmount = Number(planAmountInput.val());
                const referralReward = Number(referralRewardInput.val());
                const totalAmount = referralCommissionTotal + referralReward;
                const currency = "{{getCurrencyName()}}";
                const finalAmount = planAmount - totalAmount;

                if (planAmount > totalAmount) {
                    $('.admin-commission').html(`<span class="text--success">{{ __('admin.placeholder.take_commission') }} : ${parseFloat(finalAmount).toFixed(2)} ${currency}</span>`);

                } else {
                    $('.admin-commission').html(`<span class="text--danger">{{ __('admin.placeholder.loss_commission') }} : ${parseFloat(finalAmount).toFixed(2)} ${currency}</span>`);
                }
            }

            $(document).on('keyup', '.referral-commission-amount, #amount, #referral-reward', function onInputChange() {
                calculateAdminGainLoss();
            });
        });
    </script>
@endpush


