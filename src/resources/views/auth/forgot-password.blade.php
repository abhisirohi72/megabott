@php
    $fixedCryptoCoinContent = \App\Services\FrontendService::getFrontendContent(\App\Enums\Frontend\SectionKey::CRYPTO_COIN, \App\Enums\Frontend\Content::FIXED);
@endphp

@extends('layouts.auth')
@section('content')
<main>
    <div class="form-section white img-adjust">
        <div class="linear-center"></div>
        <div class="container-fluid px-0">
            <div class="row justify-content-center align-items-center gy-5">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 col-sm-10 position-relative">
                    <div class="eth-icon">
                        <img src="{{ displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'first_crypto_coin'), "450X450") }}" alt="image">
                    </div>
                    <div class="bnb-icon">
                        <img src="{{ displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'second_crypto_coin'), "450X450") }}" alt="image">
                    </div>
                    <div class="ada-icon">
                        <img src="{{ displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'third_crypto_coin'), "450X450") }}" alt="image">
                    </div>
                    <div class="sol-icon">
                        <img src="{{ displayImage(getArrayValue($fixedCryptoCoinContent?->meta, 'fourth_crypto_coin'), "450X450") }}" alt="image">
                    </div>

                    <div class="form-wrapper">
                        <p>{{ __('Forgot your password? Enter your email, and we’ll send a link to reset it.') }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="google_translate_element"></div>
                                <style>
                                    #google_translate_element select {
                                        background-color: #f0f0f0; /* Default dropdown background */
                                        color: #000; /* Default dropdown text color */
                                    }

                                    /* Highlight the selected value */
                                    #google_translate_element select option:checked {
                                        background-color: #007bff; /* Selected background color */
                                        color: #fff; /* Selected text color */
                                    }
                                </style>
                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                                }
                                </script>

                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="i-btn btn--lg btn--primary w-100" type="submit">{{ __('Email Password Reset Link') }}</button>
                                </div>
                            </div>

                            <div class="have-account">
                                <p class="mb-0">{{ __('Remembered your password?') }} <a href="{{ route('login') }}">{{ __('Sign In') }}</a> {{ __('here') }}.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
