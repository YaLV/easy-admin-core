<div class="sv-user-data-forms">
    <form method="post" action="{{$action}}">
        {{ csrf_field() }}
        @if($user->registered)
            <input type="hidden" name="id" value="{{$user->id}}" />
        @endif
        <div class="section">
            <div class="input-wrapper req">
                <label>E-pasts</label>
                <input type="email" name="email" value="{{ old('email')??$user->email??"" }}" />
            </div>
            <div class="input-wrapper req">
                <label>Tālrunis</label>
                <input type="text" name="phone" value="{{ old('phone')??$user->phone??"" }}" />
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper req">
                        <label>Vārds</label>
                        <input type="text" name="name" value="{{ old('name')??$user->name??"" }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-wrapper req">
                        <label>Uzvārds</label>
                        <input type="text" name="last_name" value="{{ old('last_name')??$user->last_name??"" }}" />
                    </div>
                </div>
            </div>
            <div class="sv-blank-spacer very-small"></div>
        </div>
        @if($showPassword??false)
            <div class="sv-line-spacer"></div>
            <div class="section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-wrapper req">
                            <label>Parole</label>
                            <input type="password" name="password" value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrapper req">
                            <label>Parole Atkārtoti</label>
                            <input type="password" name="password_confirmation" value="" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="sv-line-spacer"></div>
        <div class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-wrapper checkbox-large">
                        <input type="checkbox" id="is_legal" name="is_legal"
                               value="1" {{ (old('is_legal')??$user->is_legal??false)?"checked=checked":"" }}/>
                        <label for="is_legal">{{ $checkboxText??"Esmu Jurdiska persona"}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="section{{ (old("is_legal")??$user->is_legal??false)?"":" hidden" }}" id="legalform">
            <div class="input-wrapper req">
                <label>Uzņēmuma jurdiskais nosaukums</label>
                <input type="text" name="legal_name" value="{{ old('legal_name')??$user->legal_name??"" }}" />
            </div>
            <div class="input-wrapper req">
                <label>Uzņēmuma jurdiskā adrese</label>
                <input type="text" name="legal_address" value="{{ old('legal_address')??$user->legal_address??"" }}" />
            </div>
            <div class="input-wrapper req">
                <label>Reģistrācijas nr.</label>
                <input type="text" name="legal_reg_nr" value="{{ old('legal_reg_nr')??$user->legal_reg_nr??"" }}" />
            </div>
            <div class="input-wrapper req">
                <label>PVN reģistrācijas nr.</label>
                <input type="text" name="legal_vat_reg_nr"
                       value="{{ old('legal_vat_reg_nr')??$user->legal_vat_reg_nr??"" }}" />
            </div>
        </div>

        <div class="sv-line-spacer"></div>
        <div class="section">
            <div class="input-wrapper req">
                <label>Adrese (Preču piegādei)</label>
                <input type="text" name="address" value="{{ old('address')??$user->address??"" }}" />
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper req">
                        <label>Pilsēta</label>
                        <input type="text" name="city" value="{{ old('city')??$user->city??"" }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-wrapper req">
                        <label>Pasta indekss</label>
                        <input type="text" name="postal_code"
                               value="{{ old('postal_code')??$user->postal_code??"" }}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="sv-line-spacer"></div>
        <div class="section">
            @if($showComments??false)
                <div class="input-wrapper">
                    <label>Papildus komentāri</label>
                    <input type="text" name="comments" value="{{ old('comments') }}" />
                </div>
            @endif
            <div class="sv-blank-spacer very-small"></div>
            <div class="input-wrapper checkbox-large">
                <input type="checkbox" id="check-11" name="newsletter"
                       value="1" {{ (old('newsletter')??$user->newsletter??false)?"checked=checked":"" }}/>
                <label for="check-11">Vēlies saņemt Svaigi.lv jaunumus e-pastā?</label>
            </div>
            @if(!$user->registered)
                <div class="sv-blank-spacer very-small"></div>
                <div class="input-wrapper checkbox-large">
                    <input type="checkbox" id="check-12" name="rules" value="1" />
                    <label for="check-12">Piekrīti mūsu mājas lapas noteikumiem</label>
                    <a href="#">Lasīt noteikumus</a>
                </div>
            @endif
            <div class="sv-blank-spacer small"></div>
            <button class="sv-btn">{{ $buttonText??"Uz Priekšu" }}</button>
        </div>
    </form>
</div>