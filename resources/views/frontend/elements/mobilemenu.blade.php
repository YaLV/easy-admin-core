<div class="sv-menu-mobile">
    <a href="javascript:void(0)" class="sv-btn-menu toggle-sv-menu-mobile">
				<span>
					<s></s>
					<s></s>
					<s></s>
				</span>
    </a>
    <div class="content">
        <ul class="menu-dock">
            @include("frontend.partials.menu.main", ['slug' => 'main'])
        </ul>
    </div>
    @auth
        <div class="controls signed-in">
            <a href="javascript:void(0)" class="toggle-sv-signin"><img
                        src="{{ asset("assets/img/icon-user-2.svg") }}" /></a>
            <a href="#"><img src="{{ asset("assets/img/icon-doc-1.svg") }}" /></a>
            <a href="#"><img class="logout" src="{{ asset("assets/img/icon-cross-1.svg") }}" /></a>
        </div>
    @endauth
</div>

<div class="sv-mobile-menu-close-bg hidden visuallyhidden toggle-sv-menu-mobile"></div>