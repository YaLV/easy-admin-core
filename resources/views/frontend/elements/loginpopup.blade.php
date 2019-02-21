@guest
    <div class="sv-lightbox sv-signin hidden visuallyhidden">
        <div class="content">
            <div class="content-sv-signin">
                <a href="javascript:void(0)" class="sv-close toggle-sv-signin"></a>
                <div class="signin" style="background-image: url({{ asset("assets/img/tmp/photo-13.jpg") }});">
                    <form method="post" action="{{ route('frontlogin'.isDefaultLanguage()) }}">
                        @csrf
                        <img class="logo" src="{{ asset("assets/img/logo-svaigilv-1.svg") }}" />
                        <div class="input-wrapper">
                            <input type="text" name='email' placeholder="Tavs e-pasts" />
                        </div>
                        <div class="input-wrapper">
                            <input type="password" name='password' placeholder="Parole" />
                        </div>
                        <button href="#" class="sv-btn">Autorizēties</button>
                        <a href="#">Aizmirsi paroli?</a>
                    </form>
                </div>
                <div class="register">
                    <h3>Kāpēc reģistrēties?</h3>
                    <p>
                        Reģistrētiem lietotājiem ir iespēja redzēt savu pirkumu vēsturi, kā arī atkārtot kādu no
                        iepriekšējiem pasūtījumiem ar vienu peles klikšķi. Un dzīve ar mums kopā ir svaigāka!
                    </p>
                    <a href="#" class="sv-btn black">Reģistrēties</a>
                </div>
            </div>
        </div>
    </div>
@endguest