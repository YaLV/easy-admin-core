<div class="sv-error">
    @if($errors->any())
        <ul>
            {!! implode('', $errors->all('<li>:message</li>')) !!}
        </ul>
    @endif
</div>
