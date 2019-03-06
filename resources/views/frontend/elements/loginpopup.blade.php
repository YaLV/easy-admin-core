@guest
    <div class="sv-lightbox sv-signin hidden visuallyhidden">
        <div class="content">
            <div class="content-sv-signin">
                <a href="javascript:void(0)" class="sv-close toggle-sv-signin"></a>
                <div class="signin" style="background-image: url({{ asset("assets/img/tmp/photo-13.jpg") }});">
                    <form method="post" action="{{ r('frontlogin') }}">
                        @csrf
                        <img class="logo" src="{{ asset("assets/img/logo-svaigilv-1.svg") }}" />
                        <div class="input-wrapper">
                            <input type="text" name='email' placeholder="{!! __('translations.loginEmailField') !!}" />
                        </div>
                        <div class="input-wrapper">
                            <input type="password" name='password' placeholder="{!! __('translations.loginPasswordField') !!}" />
                        </div>
                        <button href="#" class="sv-btn">{!! __('translations.login') !!}</button>
                        <a href="#">{!! __('translations.forgotPassword') !!}</a>
                    </form>
                </div>
                <div class="register">
                    <h3>{!! __('translations.whyRegisterQuestion') !!}</h3>
                    <p>
                        {!! __('translations.whyRegisterAnswer') !!}
                    </p>
                    <a href="{{ r('register') }}" class="sv-btn black">{!! __('translations.register') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endguest