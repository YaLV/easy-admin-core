<div class="sv-footer">
    <div class="container">
        <div class="row">
            <ul class="menu">
                <pre>
{{ session()->get('cart') }}
{{ currentUser()->id }}
                </pre>
                @include("frontend.partials.menu.main", ['slug' => 'footer'])
            </ul>
            <div class="social">
                <a href="#" class="insta"><i class="fa fa-instagram"></i></a>
                <a href="#" class="fb"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </div>
</div>