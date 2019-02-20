<div class="sv-page-title">
    <h2>
        <a href="#">Pirceja dati</a>
    </h2>
    @if(($step??false))
        <div class="sv-cart-steps">
            <div class="container">
                <div class="row">
                    <ul>
                        <li {{ $step==1?"class=current":""}}><span>1</span></li>
                        <li {{ $step<2?"class=disabled":($step==2?"class=current":"") }}><span>2</span></li>
                        <li {{ $step<3?"class=disabled":($step==3?"class=current":"") }}><span>3</span></li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>