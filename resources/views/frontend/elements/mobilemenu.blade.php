<div class="sv-menu-mobile">
    <div class="logo">
        <a href="{{ r('page') }}"><img src="{{ asset('assets/img/logo-svaigilv-3.svg')}}"></a>
    </div>
    <a href="javascript:void(0)" class="sv-btn-menu toggle-sv-menu-mobile">
				<span>
					<s></s>
					<s></s>
					<s></s>
				</span>
    </a>

    <div class="content" style="justify-content: center;">

        <div id="sv-product-mobile-menu" class="slinky-menu slinky-theme-default" style="transition-duration: 300ms; height: 110px;">
            <ul style="transition-duration: 300ms;">
                @include("frontend.partials.menu.mobile", ['menuSlug' => 'shop'])
            </ul>
        </div>

    </div>

    <div class="sv-mobile-menu-close-bg toggle-sv-menu-mobile"></div>
</div>