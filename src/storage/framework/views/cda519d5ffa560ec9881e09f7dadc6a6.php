<?php $__env->startSection('content'); ?>
    <div class="main-content" data-simplebar>
        <div class="i-card-sm p-3 mb-4">
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
                <?php
                    $investmentIsActive= false;
                    $stakingInvestmentIsActive = false;
                    $tradeIsActive = false;
                    if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::STAKING_INVESTMENT->name)) == \App\Enums\Status::ACTIVE->value){
                        $investmentIsActive = true;
                    }
                    if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::INVESTMENT->name)) == \App\Enums\Status::ACTIVE->value){
                        $investmentIsActive = true;
                    }
                    if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == \App\Enums\Status::ACTIVE->value){
                        $tradeIsActive = true;
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <?php if($investmentIsActive || $tradeIsActive || $stakingInvestmentIsActive): ?>
                <div class="col-lg-6">
                    <div class="i-card-sm mb-4">
                        <div class="card-header">
                            <h4 class="fs-17 border--left mb-4"><?php echo e(__("Transfer the balance from your trade and investment account to your primary account, and subsequently initiate a withdrawal of your balance.")); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center gy-4">
                                <div class="user-form">
                                    <form method="POST" action="<?php echo e(route('user.wallet.transfer.own-account')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-inner">
                                                    <label for="account"><?php echo e(__('Account')); ?></label>
                                                    <select id="account" name="account" required>
                                                        <option value=""><?php echo e(__('Select One')); ?></option>
                                                        <?php if($investmentIsActive || $stakingInvestmentIsActive): ?>
                                                            <option value="<?php echo e(\App\Enums\Transaction\WalletType::INVESTMENT->value); ?>"><?php echo e(\App\Enums\Transaction\WalletType::INVESTMENT->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php if($tradeIsActive): ?>
                                                            <option value="<?php echo e(\App\Enums\Transaction\WalletType::TRADE->value); ?>"><?php echo e(\App\Enums\Transaction\WalletType::TRADE->name); ?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-inner">
                                                    <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                    <input type="number" id="amount" name="amount" placeholder="<?php echo e(__('Enter Amount')); ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="i-btn btn--primary btn--lg"><?php echo e(__('Save')); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-6">
                <div class="i-card-sm">
                    <div class="card-header">
                        <h4 class="fs-17 border--left mb-4"><?php echo e(__("Transfer the balance from your primary account to other users.")); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center gy-4">
                            <?php if(getArrayValue($setting->system_configuration, 'balance_transfer.value') == \App\Enums\Status::ACTIVE->value): ?>
                                <div class="user-form">
                                    <form method="POST" action="<?php echo e(route('user.wallet.transfer.other-account')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-inner">
                                                    <label for="user"><?php echo e(__('User')); ?> (<?php echo e(__('Check the dashboard for UID if not found.')); ?>)</label>
                                                    <input type="text" id="user" class="find-user" name="uuid" placeholder="Enter User UID" required>
                                                    <span class="user-message text-danger"></span>
                                                    <span class="user-success-message text-success"></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-inner">
                                                    <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                    <input type="number" id="amount" name="amount" placeholder="<?php echo e(__('Enter Amount')); ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="i-btn btn--primary btn--lg"><?php echo e(__('Save')); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php else: ?>
                                <p><?php echo e(__('Balance Transfer Currently Unavailable')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
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
                <p class="bonus">Today Income: $<?php echo e($get_user_today_algo); ?></p>
                <p class="auto-close" style="font-size: 20px;font-weight: bold;">Total Algo Income: ⏳ <?php echo e($total_algo); ?></p>
                <p class="period"><?php echo date('Y-m-d H:i:s') ?></p>
                
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-push'); ?>
    <script>
        $('.find-user').on('focusout', function(e) {
            const url = '<?php echo e(route('user.find.user')); ?>';
            const uuid = $(this).val();
            const token = '<?php echo e(csrf_token()); ?>';

            const data = {
                uuid: uuid,
                _token: token
            };

            $.get(url, data, function(response) {
                if (response.status) {
                    $('.user-message').text(response.message);
                } else {
                    $('.user-success-message').text(response.message);
                }
            });
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/dgtec3yk/megabott.com/src/resources/views/user/wallet-top-up.blade.php ENDPATH**/ ?>