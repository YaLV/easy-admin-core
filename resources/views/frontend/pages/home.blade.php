@extends('layouts.app')

@section('content')
    <div class="sv-page-title-banner">
        <div class="title">
            <h3>Svaigi produkti tieši no zemniekiem</h3>
            <h4>ar piegāde līdz pat mājām</h4>
        </div>
        <div class="bg-parallax">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-2.jpg')}});"></div>
        </div>
    </div>

    <div class="sv-image-banner">
        <div class="item">
            <a href="#" class="link"></a>
            <div class="title">
                <h3>Vasaras baudas</h3>
            </div>
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-3.jpg')}});"></div>
            <div class="sizing"></div>
        </div>
        <div class="item">
            <a href="#" class="link"></a>
            <div class="title">
                <h3>Oranžās garšas</h3>
            </div>
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-4.jpg')}});"></div>
            <div class="sizing"></div>
        </div>
    </div>

    <div class="sv-blank-spacer small"></div>

    <div class="sv-title">
        <h3>Populāri</h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-product-card-slider">
        <div class="owl-carousel">
            <div class="sv-product-card sale">
                <div class="sv-tag sale">
                    Akcija
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-5.jpg')}});">
                    <div class="sv-badge">
                        <img src="{{asset('assets/img/badge-bio-1.svg')}}" />
                    </div>
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <div class="sv-tag new">
                    Jauns
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-6.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <select>
                        <option>
                            3.59 € / 500 g
                        </option>
                        <option>
                            7.59 € / 700 g
                        </option>
                        <option>
                            9.59 € / 800 g
                        </option>
                    </select>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <div class="sv-tag sugg">
                    Jauns
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-7.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card sale">
                <div class="sv-tag sale">
                    Akcija
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-5.jpg')}});">
                    <div class="sv-badge">
                        <img src="{{asset('assets/img/badge-bio-1.svg')}}" />
                    </div>
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <div class="sv-tag new">
                    Jauns
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-6.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <select>
                        <option>
                            3.59 € / 500 g
                        </option>
                        <option>
                            7.59 € / 700 g
                        </option>
                        <option>
                            9.59 € / 800 g
                        </option>
                    </select>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
						<span class="icon">
							<s></s>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
								<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
							</svg>
						</span>
                </a>
            </div>
            <div class="sv-product-card">
                <div class="sv-tag sugg">
                    Jauns
                </div>
                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-7.jpg')}});">
                    <div class="sizing"></div>
                </a>
                <div class="text">
                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                    <h4><a href="#">Kunturi</a></h4>
                </div>
                <a href="#" class="add-to-cart">
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

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-farmer-products" style="background-color: #f3f3f3;">
        <div class="container">
            <div class="sv-blank-spacer big"></div>
            <div class="row">

                <div class="intro">
                    <a href="#" class="farmer">
                        <img src="{{asset('assets/img/tmp/photo-9.jpg')}}" />
                        <h3>z/s Cimbuļi</h3>
                        <h4>no Amatas</h4>
                    </a>
                    <h3><a href="#">Svaigi gaļas izstrādājumi, audzēti pēc labākajām BIO tradīcijām</a></h3>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                    </p>
                </div>

                <div class="products">

                    <div class="sv-product-card-slider">
                        <div class="owl-carousel">
                            <div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-5.jpg')}});">
                                    <div class="sv-badge">
                                        <img src="{{asset('assets/img/badge-bio-1.svg')}}" />
                                    </div>
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-6.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <select>
                                        <option>
                                            3.59 € / 500 g
                                        </option>
                                        <option>
                                            7.59 € / 700 g
                                        </option>
                                        <option>
                                            9.59 € / 800 g
                                        </option>
                                    </select>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-7.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-5.jpg')}});">
                                    <div class="sv-badge">
                                        <img src="{{asset('assets/img/badge-bio-1.svg')}}" />
                                    </div>
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-6.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-1.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <select>
                                        <option>
                                            3.59 € / 500 g
                                        </option>
                                        <option>
                                            7.59 € / 700 g
                                        </option>
                                        <option>
                                            9.59 € / 800 g
                                        </option>
                                    </select>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z" />
											</svg>
										</span>
                                </a>
                            </div>
                            <div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url({{asset('assets/img/tmp/photo-7.jpg')}});">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <h3><s>3.59 €</s>3.59 € / 500 g</h3>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
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

                </div>
            </div>
            <div class="sv-blank-spacer medium"></div>
        </div>
        <div class="bg-static">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-8.jpg')}});"></div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-title">
        <h3>Noderīgi</h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-blog-list">
        <div class="container">
            <div class="row">
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Vasarā baudi tēju aukstu!</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-10.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Kā kopt baziliku podiņā</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-11.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-12.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-steps">
        <div class="sv-blank-spacer medium"></div>
        <div class="sv-title">
            <h3>Kā tas notiek</h3>
            <p>
                Zemnieki produktus piegādā 2x nedeļē, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
            </p>
        </div>
        <div class="sv-blank-spacer medium"></div>
        <div class="container">
            <div class="row">
                <div class="item">
                    <div class="nr">
                        <span>1</span>
                    </div>
                    <h3>Izvēlies tirgus dienu</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļē, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
                <div class="item">
                    <div class="nr">
                        <span>2</span>
                    </div>
                    <h3>Iepērcies, kā jebkurā internetveikalā</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļā, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
                <div class="item">
                    <div class="nr">
                        <span>3</span>
                    </div>
                    <h3>Saņem svaigus produktus pie mums vai ar piegādi</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļā, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
            </div>
        </div>
        <div class="sv-blank-spacer big"></div>
        <div class="bg-parallax">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-2.jpg')}});"></div>
        </div>
    </div>    
@endsection