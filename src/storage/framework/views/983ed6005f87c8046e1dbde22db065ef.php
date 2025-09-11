<?php $__env->startSection('content'); ?>
    <div class="main-content" data-simplebar>
        <div id="tsparticles"></div>
        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                    <span class="text--light"><?php echo e(__('Primary Balance')); ?></span><span class="text-white fw-bold"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->primary_balance)); ?></span>
                </div>
            </div>
            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == \App\Enums\Status::ACTIVE->value): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                        <span class="text--light"><?php echo e(__('Investment Balance')); ?></span> <span class="text-white fw-bold"> <?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->investment_balance)); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == \App\Enums\Status::ACTIVE->value): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                        <span class="text--light"><?php echo e(__('Trade Balance')); ?></span> <span class="text-white fw-bold"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()->wallet->trade_balance)); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-4 col-md-6">
                <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                    <span class="text--light"><?php echo e(__('Leverage Income')); ?></span><span class="text-white fw-bold"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($get_user_liverage)); ?></span>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                    <span class="text--light"><?php echo e(__('Today Algo Income')); ?></span><span class="text-white fw-bold"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($get_user_today_algo)); ?></span>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="i-card-sm style-2 bg--dark shadow-none rounded-2">
                    <span class="text--light"><?php echo e(__('Total Algo Income')); ?></span><span class="text-white fw-bold"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($total_algo)); ?></span>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="i-card-sm mb-4 p-3">
                    <label for="referral-url" class="form-label">Referral URL</label>
                    <div class="input-group">
                        <input type="text" id="referral-url" class="form-control reference-url"
                            value="<?php echo e(route('register', ['reference' => \Illuminate\Support\Facades\Auth::user()->uuid])); ?>"
                            aria-label="Recipient's username" aria-describedby="reference-copy" readonly>
                        <span class="input-group-text bg--primary text-white" id="reference-copy"><?php echo e(__('Copy')); ?><i
                                class="las la-copy ms-2"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="i-card-sm mb-4 p-3">
                    <label for="user-uid" class="form-label">UID</label>
                    <div class="input-group">
                        <input type="text" id="user-uid" class="form-control user-uid"
                            value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->uuid); ?>" aria-label="Recipient's username"
                            aria-describedby="user-uid-copy" readonly>
                        <span class="input-group-text bg--primary text-white" id="user-uid-copy"><?php echo e(__('Copy')); ?><i
                                class="las la-copy ms-2"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="i-card-sm mb-4">
            <div class="row g-4">
                <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == 1): ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="i-card-sm card-style rounded-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="title text--purple mb-4"><?php echo e(__('frontend.dashboard.investment.index')); ?></h5>
                                <div class="avatar--lg bg--pink">
                                    <i class="bi bi-credit-card text-white"></i>
                                </div>
                            </div>

                            <div class="card-info text-center">
                                <ul class="user-card-list w-100">
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.investment.total')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investmentReport->total)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.investment.profit')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investmentReport->profit)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.investment.running')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($investmentReport->running)); ?></span>
                                    </li>
                                </ul>
                                <a href="<?php echo e(route('user.investment.index')); ?>"
                                    class="btn--white"><?php echo e(__('frontend.dashboard.investment.now')); ?><i
                                        class="bi bi-box-arrow-up-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::MATRIX->name)) == 1): ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="i-card-sm card-style rounded-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="title text--blue mb-4"><?php echo e(__('frontend.dashboard.matrix.index')); ?></h5>
                                <div class="avatar--lg bg--blue">
                                    <i class="bi bi-wallet text-white"></i>
                                </div>
                            </div>
                            <div class="card-info text-center">
                                <ul class="user-card-list mb-4 w -100">
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.matrix.total')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(@$matrixInvest->referral_commissions + @$matrixInvest->level_commissions)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.matrix.referral')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(@$matrixInvest->referral_commissions)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.matrix.level')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(@$matrixInvest->level_commissions)); ?></span>
                                    </li>
                                </ul>
                                <a href="<?php echo e(route('user.matrix.index')); ?>"
                                    class="btn--white"><?php echo e(__('frontend.dashboard.matrix.enrolled')); ?><i
                                        class="bi bi-box-arrow-up-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 1): ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="i-card-sm card-style rounded-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="title mb-0 text--yellow"><?php echo e(__('frontend.dashboard.trade.index')); ?></h5>
                                <div class="avatar--lg bg--yellow">
                                    <i class="bi bi-bar-chart text-white"></i>
                                </div>
                            </div>

                            <div class="card-info text-center">
                                <ul class="user-card-list w-100">
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.trade.total')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($tradeReport->total)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.trade.wining')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($tradeReport->wining)); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between gap-3"><span
                                            class="fw-bold"><?php echo e(__('frontend.dashboard.trade.loss')); ?></span>
                                        <span
                                            class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($tradeReport->loss)); ?></span>
                                    </li>
                                </ul>
                                <a href="<?php echo e(route('user.trade.index')); ?>" class="btn--white"><?php echo e(__('Start Trading')); ?> <i
                                        class="bi bi-box-arrow-up-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-8">
                <div class="i-card-sm">
                    <h5 class="title mb-4"><?php echo e(__('frontend.dashboard.deposit_withdraw.monthly_report')); ?></h5>
                    <div id="monthlyChart"></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="i-card-sm">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <div class="i-card-sm style-border-blue blue border rounded-3">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="title danger mb-0"><?php echo e(__('frontend.dashboard.deposit.index')); ?></h5>
                                    <div class="avatar--lg bg--blue">
                                        <i class="bi bi-wallet text-white"></i>
                                    </div>
                                </div>
                                <div class="card-info text-center">
                                    <ul class="user-card-list w -100">
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.deposit.total')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($deposit, 'total'))); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.deposit.primary')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($deposit, 'primary.amount'))); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.deposit.investment')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($deposit, 'investment.amount'))); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.deposit.trade')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($deposit, 'trade.amount'))); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6">
                            <div class="i-card-sm style-border-green green border rounded-3">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="title mb-0"><?php echo e(__('frontend.dashboard.withdraw.index')); ?></h5>
                                    <div class="avatar--lg bg--green">
                                        <i class="bi bi-credit-card text-white"></i>
                                    </div>
                                </div>


                                <div class="card-info text-center">
                                    <ul class="user-card-list w-100">
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.withdraw.total')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($withdraw->total)); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.withdraw.charge')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($withdraw->charge)); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.withdraw.pending')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($withdraw->pending)); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between gap-3 mb-2"><span
                                                class="fw-bold"><?php echo e(__('frontend.dashboard.withdraw.rejected')); ?></span>
                                            <span
                                                class="fw-bold text--dark"><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount($withdraw->rejected)); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="i-card-sm">
                    <div class="card-info">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="title"><?php echo e(__('Commissions')); ?></h5>
                            <a class="arrow--btn" href="<?php echo e(route('user.referral.index')); ?>"><?php echo e(__('Referral Program')); ?>

                                <i class="bi bi-arrow-right-short"></i></a>
                        </div>
                        <div class="total-balance-wrapper">
                            <div class="total-balance">
                                <p><?php echo e(__('Investment Commission')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($commissions, 'investment'))); ?>

                                    </h4>
                                </div>
                            </div>
                            <div class="total-balance">
                                <p><?php echo e(__('Referral Commission')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($commissions, 'referral'))); ?>

                                    </h4>
                                </div>
                            </div>
                            <div class="total-balance">
                                <p><?php echo e(__('Level Commission')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(getArrayValue($commissions, 'level'))); ?>

                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="i-card-sm">
                    <div class="card-info">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="title"><?php echo e(__('Wallets')); ?></h5>
                            <a class="arrow--btn" href="<?php echo e(route('user.wallet.index')); ?>"><?php echo e(__('Wallet Top Up')); ?> <i
                                    class="bi bi-arrow-right-short"></i></a>
                        </div>
                        <div class="total-balance-wrapper">
                            <div class="total-balance">
                                <p><?php echo e(__('Primary Balance')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()?->wallet->primary_balance)); ?>

                                    </h4>
                                </div>
                            </div>
                            <div class="total-balance">
                                <p><?php echo e(__('Investment Balance')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()?->wallet->investment_balance)); ?>

                                    </h4>
                                </div>
                            </div>
                            <div class="total-balance">
                                <p><?php echo e(__('Trade Balance')); ?></p>
                                <div class="d-flex gap-2">
                                    <h4><?php echo e(getCurrencySymbol()); ?><?php echo e(shortAmount(Auth::user()?->wallet->trade_balance)); ?>

                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="i-card-sm">
                    <div class="card-header">
                        <h4 class="title"><?php echo e(__('Latest Transactions')); ?></h4>
                    </div>
                    <?php echo $__env->make('user.partials.transaction', [
                        'transactions' => $transactions,
                        'is_paginate' => false,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            top: 10px;
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
    </style>

    <!-- Modal Structure -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color:#000;"><?php echo e($notifications->name); ?></h2>
            <img src="<?php echo e(displayImage($notifications->image)); ?>" alt="">
            <p style="color: #000;"><?php echo e($notifications->description); ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-push'); ?>
    <script>
        "use strict";
        $(document).ready(function() {
            const depositMonthAmount = <?php echo json_encode($depositMonthAmount, 15, 512) ?>;
            const withdrawMonthAmount = <?php echo json_encode($withdrawMonthAmount, 15, 512) ?>;
            const months = <?php echo json_encode($months, 15, 512) ?>;
            const currency = "<?php echo e(getCurrencySymbol()); ?>";

            const options = {
                series: [{
                        name: 'Total Deposits Amount',
                        data: depositMonthAmount
                    },
                    {
                        name: 'Total Withdraw Amount',
                        data: withdrawMonthAmount
                    }
                ],
                chart: {
                    height: 530,
                    type: 'line',
                    toolbar: false,
                    zoom: {
                        enabled: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'bottom',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return '';
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: months,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    },
                    labels: {
                        style: {
                            colors: '#ffffff'
                        }
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return currency + val;
                        },
                        style: {
                            colors: '#ffffff'
                        }
                    }
                },
                title: {
                    floating: true,
                    offsetY: 340,
                    align: 'center',
                    style: {
                        color: '#222',
                        fontWeight: 600
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#monthlyChart"), options);
            chart.render();

            $('#reference-copy').click(function() {
                const copyText = $('.reference-url');
                copyText.select();
                document.execCommand('copy');
                copyText.blur();
                notify('success', 'Copied to clipboard!');
            });

            $('#user-uid-copy').click(function() {
                const copyTextUID = $('.user-uid');
                copyTextUID.select();
                document.execCommand('copy');
                copyTextUID.blur();
                notify('success', 'Copied to clipboard!');
            });

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
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/dashboard.blade.php ENDPATH**/ ?>