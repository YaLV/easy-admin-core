<div class="sv-products-menu has-large-dropdown" data-spy="affix" data-offset-top="90">
    <div>
        <ul>
            @include("frontend.partials.menu.main", ['menuSlug' => 'shop'])
            <li class="sv-default-dropdown-toggle">
                <a href="#"><span>Citi</span></a>
                <div class="sv-dropdown sv-default-dropdown">
                    <div class="left">
                        <ul>
                            <li>
                                <a href="#">Gaļa</a>
                            </li>
                            <li>
                                <a href="#">Zivis</a>
                            </li>
                            <li>
                                <a href="#">Dārzeņi</a>
                            </li>
                            <li>
                                <a href="#">Augļi</a>
                            </li>
                            <li>
                                <a href="#">Piens</a>
                            </li>
                            <li>
                                <a href="#">Olas</a>
                            </li>
                            <li>
                                <a href="#">Maize</a>
                            </li>
                            <li>
                                <a href="#">Konditoreja</a>
                            </li>
                            <li>
                                <a href="#">Kaut kas vēl</a>
                            </li>
                        </ul>
                    </div>
                    <div class="right">
                        <div class="bg-static">
                            <div class="image" style="background-image: url({{ asset("assets/img/tmp/photo-15.jpg") }});"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="cart has-items">
            <a href="#">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
            </a>
            <div class="sv-dropdown sv-cart-dropdown">
                <div class="item-list minicart-contents">
                    @foreach($frontController->getCartItems() as $item)
                        @include("Orders::frontend.partials.miniitem")
                    @endforeach
                </div>
                <a href="#" class="go-to-cart"><span>Atvērt grozu</span></a>
            </div>
        </div>
    </div>
</div>