<div class="sv-products-menu has-large-dropdown" data-spy="affix" data-offset-top="90">
    <div>
        <ul>
            @include("frontend.partials.menu.main", ['menuSlug' => 'shop'])
        </ul>
        <div class="cart {{ $frontController->cartHasItems() }}">
            <a href="{{ r('cart') }}">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
            </a>
        </div>
    </div>
</div>