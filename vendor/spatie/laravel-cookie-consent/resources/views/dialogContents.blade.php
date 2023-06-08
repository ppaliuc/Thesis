<div class="cookie-bar-wrap show js-cookie-consent cookie-consent">
    <div class="container d-flex justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="row justify-content-center">
                <div class="cookie-bar">
                    <div class="cookie-bar-text cookie-consent__message">
                        @php
                            echo $gs->cookie_text;
                        @endphp
                    </div>
                    <div class="cookie-bar-action js-cookie-consent-agree cookie-consent__agree">
                        <button class="btn btn-primary btn-accept my-2">
                            {{ $gs->cookie_button }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
