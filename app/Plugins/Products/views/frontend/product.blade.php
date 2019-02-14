@extends('Categories::frontend.list')

@section('wrapper')
    sv-product-single-wrapper
@endsection

@section('leftSide')

    <div class="sv-product-single-content">

        <div class="sv-product-single-header">

            <div class="sv-product-description">
                @if($product->isBio)
                <div class="sv-badge">
                    <img src="{{ asset('assets/img/badge-bio-1.svg')}}">
                </div>
                @endif
                <img src="{{ $product->image() }}" class="title-image">
                <div class="text">
                    {{ $product->getMeta('description') }}
                </div>
                <div class="sv-exp-date">
                    <b>Exp. dat</b>
                </div>
            </div>

            <div class="sv-product-title">
                <div class="title">
                    <h2>Liellopa gaļa malšanai</h2>
                    <div class="breadcrumbs">
                        <a href="#">Gaļa</a>
                        <a href="#">Cūkgaļa</a>
                    </div>
                    <a href="#" class="farmer">
                        <img src="img/tmp/photo-9.jpg">
                        <h3>z/s Cimbuļi</h3>
                    </a>
                </div>
                <form>
                    <input type="text" value="3.59 € / 500 g">
                    <div class="selectric-wrapper"><div class="selectric-hide-select"><select tabindex="-1">
                                <option>
                                    3.59 € / 500 g
                                </option>
                                <option>
                                    5.59 € / 600 g
                                </option>
                                <option>
                                    9.59 € / 700 g
                                </option>
                            </select></div><div class="selectric"><span class="label">
											3.59 € / 500 g
										</span><b class="button">▾</b></div><div class="selectric-items" tabindex="-1"><div class="selectric-scroll"><ul><li data-index="0" class="selected">
                                        3.59 € / 500 g
                                    </li><li data-index="1" class="">
                                        5.59 € / 600 g
                                    </li><li data-index="2" class="last">
                                        9.59 € / 700 g
                                    </li></ul></div></div><input class="selectric-input" tabindex="0"></div>
                    <div class="input-wrapper quantity">
                        <span class="button minus disabled"></span>
                        <span class="button add"></span>
                        <input type="text" value="1" class="qty">
                    </div>
                    <a href="#" class="sv-btn">Pievienot grozam</a>
                </form>
            </div>

        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-marketday-access">
            <h3>Tirgus dienas, kurās produkts pieejams</h3>
            <p>
                Trigus diena ir diena, uz kuru vari veikt pasūtījumu. Svaigi.lv organizē produktu pasūtījumus no saimniecībām uz divām Tirgus dienām nedēļā - Pirmdienu un Ceturtdienu.
            </p>
            <div class="sv-blank-spacer medium"></div>
            <div class="days">
                <div class="sv-day is-disabled">
                    <div>
                        <div class="nr">
                            <span>14</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Pirmdiena
                        </div>
                    </div>
                </div>
                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>

                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>
                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>
                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>
                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>
                <div class="sv-day">
                    <div>
                        <div class="nr">
                            <span>17</span>
                            <span>augusts</span>
                        </div>
                        <div class="name">
                            Trešdiena
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-farmer-about">
            <a href="#" class="farmer">
                <img src="img/tmp/photo-9.jpg">
                <h3>z/s Cimbuļi</h3>
                <h4>no Amatas</h4>
            </a>
            <h5>Svaigi gaļas izstrādājumi, audzēti pēc labākajām BIO tradīcijām</h5>
            <p>
                Zemnieku saimniecība Rūķīši no Rencēnu pagasta.<br>
                Saimniecība Rūķīši ir dibināta 1992. gadā. Saimniecības pamata nodarbošanās ir tradicionālās lauksaimniecības ražošanas nozares - graudkopība un lopkopība. Saimniecība 643 ha bioloģiski sertificētās platībās audzē vairāk kā 300 gaļas liellopus un 200 staltbriežus. &nbsp;Mūsu pircējiem saimniecība piedāvā svaigu bioloģiski sertificētu liellopa un brieža gaļu, kā arī dažādus gaļas produktus. Saimniecība piedāvā īpaši nogatavinātu gaļu, vairāk par to lasi mūsu blogā <a href="#">šeit</a>!<br>
                Bioloģiskās pārstrādes sertifikāts Nr. 05-0322--8/P-01.<br><br>
                Brieža gaļas receptes gardām maltītēm vari atrast <a href="#">šeit</a>.
            </p>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-title">
            <h3>Citi produkti</h3>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-linked-products-slider">
            <div class="owl-carousel owl-loaded">










                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all 0s ease 0s; width: 4800px;"><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-5.jpg);">
                                    <div class="sv-badge">
                                        <img src="img/badge-bio-1.svg">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-6.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <div class="selectric-wrapper"><div class="selectric-hide-select"><select tabindex="-1">
                                                <option>
                                                    3.59 € / 500 g
                                                </option>
                                                <option>
                                                    7.59 € / 700 g
                                                </option>
                                                <option>
                                                    9.59 € / 800 g
                                                </option>
                                            </select></div><div class="selectric"><span class="label">
												3.59 € / 500 g
											</span><b class="button">▾</b></div><div class="selectric-items" tabindex="-1"><div class="selectric-scroll"><ul><li data-index="0" class="selected">
                                                        3.59 € / 500 g
                                                    </li><li data-index="1" class="">
                                                        7.59 € / 700 g
                                                    </li><li data-index="2" class="last">
                                                        9.59 € / 800 g
                                                    </li></ul></div></div><input class="selectric-input" tabindex="0"></div>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-7.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item active" style="width: 210px; margin-right: 30px;"><div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item active" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-5.jpg);">
                                    <div class="sv-badge">
                                        <img src="img/badge-bio-1.svg">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item active" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-6.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item active" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <div class="selectric-wrapper"><div class="selectric-hide-select"><select tabindex="-1">
                                                <option>
                                                    3.59 € / 500 g
                                                </option>
                                                <option>
                                                    7.59 € / 700 g
                                                </option>
                                                <option>
                                                    9.59 € / 800 g
                                                </option>
                                            </select></div><div class="selectric"><span class="label">
												3.59 € / 500 g
											</span><b class="button">▾</b></div><div class="selectric-items" tabindex="-1"><div class="selectric-scroll"><ul><li data-index="0" class="selected">
                                                        3.59 € / 500 g
                                                    </li><li data-index="1" class="">
                                                        7.59 € / 700 g
                                                    </li><li data-index="2" class="last">
                                                        9.59 € / 800 g
                                                    </li></ul></div></div><input class="selectric-input" tabindex="0"></div>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item active" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-7.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item" style="width: 210px; margin-right: 30px;"><div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-5.jpg);">
                                    <div class="sv-badge">
                                        <img src="img/badge-bio-1.svg">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-6.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <div class="selectric-wrapper"><div class="selectric-hide-select"><select tabindex="-1">
                                                <option>
                                                    3.59 € / 500 g
                                                </option>
                                                <option>
                                                    7.59 € / 700 g
                                                </option>
                                                <option>
                                                    9.59 € / 800 g
                                                </option>
                                            </select></div><div class="selectric"><span class="label">
												3.59 € / 500 g
											</span><b class="button">▾</b></div><div class="selectric-items" tabindex="-1"><div class="selectric-scroll"><ul><li data-index="0" class="selected">
                                                        3.59 € / 500 g
                                                    </li><li data-index="1" class="">
                                                        7.59 € / 700 g
                                                    </li><li data-index="2" class="last">
                                                        9.59 € / 800 g
                                                    </li></ul></div></div><input class="selectric-input" tabindex="0"></div>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-7.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card sale">
                                <div class="sv-tag sale">
                                    Akcija
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-5.jpg);">
                                    <div class="sv-badge">
                                        <img src="img/badge-bio-1.svg">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag new">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-6.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-1.jpg);">
                                    <div class="sizing"></div>
                                </a>
                                <div class="text">
                                    <h2><a href="#">Cūkgaļas fileja</a></h2>
                                    <div class="selectric-wrapper"><div class="selectric-hide-select"><select tabindex="-1">
                                                <option>
                                                    3.59 € / 500 g
                                                </option>
                                                <option>
                                                    7.59 € / 700 g
                                                </option>
                                                <option>
                                                    9.59 € / 800 g
                                                </option>
                                            </select></div><div class="selectric"><span class="label">
												3.59 € / 500 g
											</span><b class="button">▾</b></div><div class="selectric-items" tabindex="-1"><div class="selectric-scroll"><ul><li data-index="0" class="selected">
                                                        3.59 € / 500 g
                                                    </li><li data-index="1" class="">
                                                        7.59 € / 700 g
                                                    </li><li data-index="2" class="last">
                                                        9.59 € / 800 g
                                                    </li></ul></div></div><input class="selectric-input" tabindex="0"></div>
                                    <h4><a href="#">Kunturi</a></h4>
                                </div>
                                <a href="#" class="add-to-cart">
										<span class="icon">
											<s></s>
											<svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div><div class="owl-item cloned" style="width: 210px; margin-right: 30px;"><div class="sv-product-card">
                                <div class="sv-tag sugg">
                                    Jauns
                                </div>
                                <a href="#" class="image" style="background-image: url(img/tmp/photo-7.jpg);">
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
												<path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
											</svg>
										</span>
                                </a>
                            </div></div></div></div><div class="owl-nav"><div class="owl-prev"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path class="bg" d="M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z"></path><path class="arrow" d="M16.929,25.657l1.414,1.414,0.157-.157L29.657,38.071l1.414-1.414L19.914,25.5,31.071,14.343l-1.414-1.414L18.5,24.086l-0.157-.157-1.414,1.414L17.086,25.5Z"></path></svg></div><div class="owl-next"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path class="bg" d="M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z"></path><path class="arrow" d="M33.071,25.657l-1.414,1.414L31.5,26.914,20.343,38.071l-1.414-1.414L30.086,25.5,18.929,14.343l1.414-1.414L31.5,24.086l0.157-.157,1.414,1.414-0.157.157Z"></path></svg></div></div><div class="owl-dots disabled"></div></div>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-title">
            <h3>Saistītie raksti</h3>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-blog-list-slider">
            <div class="owl-carousel owl-loaded">





                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: all 0s ease 0s; width: 4400px;"><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-12.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā kopt baziliku podiņā</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-11.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-12.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item active" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Vasarā baudi tēju aukstu!</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-10.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item active" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā kopt baziliku podiņā</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-11.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item active" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-12.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā kopt baziliku podiņā</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-11.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-12.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Vasarā baudi tēju aukstu!</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-10.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā kopt baziliku podiņā</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-11.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div><div class="owl-item cloned" style="width: 370px; margin-right: 30px;"><div class="item has-loaded">
                                <a href="#" class="link"></a>
                                <div class="title">
                                    <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                                </div>
                                <div class="image" style="background-image: url(img/tmp/photo-12.jpg);"></div>
                                <div class="sizing"></div>
                            </div></div></div></div><div class="owl-nav"><div class="owl-prev"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path class="bg" d="M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z"></path><path class="arrow" d="M16.929,25.657l1.414,1.414,0.157-.157L29.657,38.071l1.414-1.414L19.914,25.5,31.071,14.343l-1.414-1.414L18.5,24.086l-0.157-.157-1.414,1.414L17.086,25.5Z"></path></svg></div><div class="owl-next"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path class="bg" d="M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z"></path><path class="arrow" d="M33.071,25.657l-1.414,1.414L31.5,26.914,20.343,38.071l-1.414-1.414L30.086,25.5,18.929,14.343l1.414-1.414L31.5,24.086l0.157-.157,1.414,1.414-0.157.157Z"></path></svg></div></div><div class="owl-dots disabled"></div></div>
        </div>

    </div>

@endsection