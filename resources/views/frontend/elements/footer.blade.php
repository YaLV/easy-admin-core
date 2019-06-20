<div class="sv-footer sticky-stopper">
    <div class="container">
        <div class="row">
            <ul class="menu">
                @include("frontend.partials.menu.main", ['slug' => 'footer'])
            </ul>
            <div class="social">
                <a href="{{ __('translations.instaUrl') }}" class="insta"><i class="fa fa-instagram"></i></a>
                <a href="{{ __('translations.fbUrl') }}" class="fb"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </div>
</div>