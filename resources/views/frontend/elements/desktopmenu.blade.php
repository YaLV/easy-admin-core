<div class="row">
    <span class="sv-menu-mobile-close"></span>
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset("assets/img/logo-svaigilv-1.svg") }}" /></a>
    </div>
    <a href="javascript:void(0)" class="sv-btn-menu toggle-sv-menu-mobile">
						<span>
							<s></s>
							<s></s>
							<s></s>
						</span>
    </a>
    <div class="menu">
        <ul>
            @include("frontend.partials.menu.main", ['slug' => 'main'])
        </ul>
    </div>
    <div class="right">
        <div class="user">
            <a href="javascript:void(0)" {{(Auth::user() && Auth::user()->registered)?"":"class=toggle-sv-signin"}}>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21">
                        <path d="M21.162,21A10,10,0,0,0,2.838,21H0.7A11.984,11.984,0,0,1,23.3,21h-2.14ZM12,10a5,5,0,1,1,5-5A5,5,0,0,1,12,10Zm0-8a3,3,0,1,0,3,3A3,3,0,0,0,12,2Z" />
                    </svg>
                </span>
            </a>
            @if(Auth::user() && Auth::user()->registered)
            <div class="sv-dropdown sv-user-dropdown">
                <ul>
                    @if(auth::user()->isAdmin())
                        <li class="admin">
                            <a href="{{ route('dashboard') }}"><span>Admin</span></a>
                        </li>
                    @endif
                    <li class="history">
                        <a href="#"><span>Pirkumu vēsture</span></a>
                    </li>
                    <li class="docs">
                        <a href="#"><span>Profila dati</span></a>
                    </li>
                    <li>
                        <a href="{{ route('frontlogout'.isDefaultLanguage()) }}"><span>Iziet</span></a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
        <div class="cart has-items">
            <a href="{{ route('cart'.isDefaultLanguage()) }}">
                <span class="icon">
                    <s></s>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
                        <path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
                    </svg>
                </span>
                <span class="minicart-totals">{{ $frontController->getCartTotals()->toPay }} €</span>
            </a>
            <div class="sv-dropdown sv-cart-dropdown">
                <div class="item-list minicart-contents">
                    @foreach($frontController->getCartItems() as $item)
                        @include("Orders::frontend.partials.miniitem")
                    @endforeach
                </div>
                <a href="{{ route('cart'.isDefaultLanguage()) }}" class="go-to-cart"><span>Atvērt grozu</span></a>
            </div>
        </div>
    </div>
</div>