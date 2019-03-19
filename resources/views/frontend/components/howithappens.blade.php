<div class="sv-steps">
    <div class="sv-blank-spacer medium"></div>
    <div class="sv-title">
        <h3>{{ $component->getData('howheader') }}</h3>
        <p>
            {{ $component->getData('howdescription') }}
        </p>
    </div>
    <div class="sv-blank-spacer medium"></div>
    <div class="container">
        <div class="row">
            <div class="item">
                <div class="nr">
                    <span>1</span>
                </div>
                <h3>{{ $component->getData('howstep1title') }}</h3>
                <p>
                    {{ $component->getData('howstep1description') }}
                </p>
            </div>
            <div class="item">
                <div class="nr">
                    <span>2</span>
                </div>
                <h3>{{ $component->getData('howstep2title') }}</h3>
                <p>
                    {{ $component->getData('howstep2description') }}
                </p>
            </div>
            <div class="item">
                <div class="nr">
                    <span>3</span>
                </div>
                <h3>{{ $component->getData('howstep3title') }}</h3>
                <p>
                    {{ $component->getData('howstep3description') }}
                </p>
            </div>
        </div>
    </div>
    <div class="sv-blank-spacer big"></div>
    <div class="bg-parallax">
        <div class="image" style="background-image: url({{ $component->getComponentImage() }});"></div>
    </div>
</div>