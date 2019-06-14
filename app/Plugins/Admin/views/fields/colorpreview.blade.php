@push('css')
    <style>
        .sv-message {
            padding: 10px;
            font-size: 16px;
            line-height: 26px;
            font-family: "DINPro Medium", sans-serif;
            text-align: center;
            color: #000000;
            margin-bottom: 20px;
        }

        .sv-message > div {
            padding: 15px 100px;
            position: relative;
            background: #f5f5f5;
        }

        .sv-message .sv-close {
            width: 22px;
            height: 21px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 20px;
            display: block;
        }

        .sv-message > div a {
            color: #1f9363;
            text-decoration: underline;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('document').ready(function () {
            setTimeout(function () {
                $('.colorSelector').each(function () {
                    $(this).ColorPickerSetColor($(this).data('defaultcolor'));
                    updatePreview();
                })
            }, 100);
        });

        function updatePreview() {
            textColor = $('#textColorSelector').find('div.colorpicker_hex > input').val();
            urlColor = $('#urlColorSelector').find('div.colorpicker_hex > input').val();
            bgColor = $('#bgColorSelector').find('div.colorpicker_hex > input').val();
            $('.sv-message').css('color', "#"+textColor);
            $('.sv-message > div').css('background-color', "#"+bgColor);
            $('.sv-message a, .sv-message svg').css('color', "#"+urlColor);

            $('input[name=color_text]').val(textColor);
            $('input[name=color_url]').val(urlColor);
            $('input[name=color_background]').val(bgColor);
        }

        function setDefault(target) {
            $('#'+target).ColorPickerSetColor($('#'+target).data('defaultcolor'));
            updatePreview();
        }
    </script>
@endpush

<div class="row">
    <div class="col-md-2">
        <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
    </div>
    <div class="col-md-9">
        <div class="sv-message" id="{{$id}}">
            <div style="background: #f8ddc4;">
                Izvēlies CETURTDIENU, pirms liec produktus groziņā, ja vēlies pasūtījumu saņemt šajā ceturtdienā, nodod
                to&nbsp;līdz
                plkst. 10:00!<br>
                Ieliec groziņā sezonas ogas&nbsp;vai šīs sezonas medus burciņu! <a href="#">Uzzini vairāk</a>
                <a href="#" class="sv-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21">
                        <path d="M21.253,19.339l-1.414,1.414L11,11.914,2.161,20.753,0.747,19.339,9.586,10.5,0.747,1.661,2.161,0.247,11,9.086l8.839-8.839,1.414,1.414L12.414,10.5Z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>