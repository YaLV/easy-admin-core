@if(!Auth::user() || !Auth::user()->registered)
    <div class="sv-lightbox sv-signin hidden visuallyhidden">
        <div class="content">
            <div class="content-sv-signin">
                <a href="javascript:void(0)" class="sv-close toggle-sv-signin"></a>
                <div class="signin" style="background-image: url({{ asset("assets/img/tmp/photo-13.jpg") }});">
                    <form method="post" action="{{ r('frontlogin') }}">
                        @csrf
                        <img class="logo" src="{{ asset("assets/img/logo-svaigilv-1.svg") }}" />
                        <a href='{{ r('loginFB') }}' name="Facebook" class="btn-fb">Ar Facebook</a>
                        <div class="sv-or-spacer">{{ __('translations.vai') }}</div>
                        <div class="input-wrapper">
                            <input type="text" name='email' placeholder="{!! _t('translations.loginEmailField') !!}" />
                        </div>
                        <div class="input-wrapper">
                            <input type="password" name='password' placeholder="{!! _t('translations.loginPasswordField') !!}" />
                        </div>
                        <button class="sv-btn">{!! _t('translations.login') !!}</button>
                        <a href="{{ route('password.request') }}">{!! _t('translations.forgotPassword') !!}</a>
                    </form>
                </div>
                <div class="register">
                    <h3>{!! _t('translations.whyRegisterQuestion') !!}</h3>
                    <p>
                        {!! _t('translations.whyRegisterAnswer') !!}
                    </p>
                    <a href="{{ r('register') }}" class="sv-btn black">{!! _t('translations.register') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endif