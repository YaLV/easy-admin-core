@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    <div class="sv-user-data-forms">
        <form method="post" action="{{ route('checkout.post'.isDefaultLanguage()) }}">
            {{ csrf_field() }}
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
                            <input type="text" name="name" value="{{ old('name')??$user->name??"" }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrapper req">
                            <label>Uzvārds</label>
                            <input type="text" name="last_name" value="{{ old('last_name')??$user->last_name??"" }}"/>
                        </div>
                    </div>
                </div>
                <div class="sv-blank-spacer very-small"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-wrapper checkbox-large">
                            <input type="checkbox" id="check-111" name="legal_person" value="1" {{ old('legal_person')??$user->legal_person??false?"checked=checked":"" }}/>
                            <label for="check-111">Pirkumu veikšu kā jurdiska persona</label>
                        </div>
                    </div>
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
                            <input type="text" name="city" value="{{ old('city')??$user->city??"" }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrapper req">
                            <label>Pasta indekss</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code')??$user->postal_code??"" }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sv-line-spacer"></div>
            <div class="section">

                <div class="input-wrapper">
                    <label>Papildus komentāri</label>
                    <input type="text" name="comments" value="{{ old('comments') }}"/>
                </div>
                <div class="sv-blank-spacer very-small"></div>
                <div class="input-wrapper checkbox-large">
                    <input type="checkbox" id="check-11" name="news" value="1" {{ old('news')?"checked=checked":"" }}/>
                    <label for="check-11">Vēlies saņemt Svaigi.lv jaunumus e-pastā?</label>
                </div>
                <div class="sv-blank-spacer very-small"></div>
                <div class="input-wrapper checkbox-large">
                    <input type="checkbox" id="check-12" name="rules_accepted" value="1"/>
                    <label for="check-12">Piekrīti mūsu mājas lapas noteikumiem</label>
                    <a href="#">Lasīt noteikumus</a>
                </div>
                <div class="sv-blank-spacer small"></div>
                <button class="sv-btn">Nodot pasūtījumu izpildei</button>
            </div>
        </form>
    </div>
@endsection