@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/academies.css')}}">
@endsection
@section('libraryCSS')
    <!-- Owl CSS  -->
    <link rel="stylesheet" href="owlCarousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="owlCarousel/css/owl.theme.default.min.css" />
    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
@endsection

@section('content')
    <div class="academic-header">
        <div class="content">
            <h1>We help Academies<br>to expand online</h1>
        </div>
    </div>
    <section class="partners ">
        <div class="partners-header">
            <h2 class=" mb-0">It's Better with Friends</h2>
        </div>
        <div class="row mt-0">
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/ACCA.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/DME.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/edexcel.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/Northampton.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/OTRAC.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/Pearson.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="{{asset('images/partners')}}/Trade.png" alt="">
            </div>
            <div class="col-3 logo-center ">
                <img class="partners-logo" src="" alt="">
            </div>

        </div>
    </section>




    <section class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="form-content mx-5">
                    <ul>
                        <li>
                            <div class="form-group">
                                <label for="">Academy's Name</label>
                                <input type="text" name="" id="" maxlength="20" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder=""
                                       aria-describedby="helpId">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" name="" id="" maxlength="20" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder=""
                                       aria-describedby="helpId">
                            </div>
                        </li>

                        <li>
                        <div class="form-group">
                                <label for="">Company Profile</label>
                                <div class="filepond--root filepond filepond--hopper" data-style-panel-layout="compact" data-style-button-remove-item-position="left" data-style-button-process-item-position="right" data-style-load-indicator-position="right" data-style-progress-indicator-position="right" data-style-button-remove-item-align="false" style="height: 76px;"><input class="filepond--browser" type="file" id="filepond--browser-spzwsu972" name="filepond" aria-controls="filepond--assistant-spzwsu972" aria-labelledby="filepond--drop-label-spzwsu972" accept="application/pdf"><div class="filepond--drop-label" style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label for="filepond--browser-spzwsu972" id="filepond--drop-label-spzwsu972" aria-hidden="true">Drag &amp; Drop your CV or <span class="filepond--label-action" tabindex="0">Browse</span></label></div><div class="filepond--list-scroller" style="transform: translate3d(0px, 0px, 0px);"><ul class="filepond--list" role="list"></ul></div><div class="filepond--panel filepond--panel-root" data-scalable="true"><div class="filepond--panel-top filepond--panel-root"></div><div class="filepond--panel-center filepond--panel-root" style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);"></div><div class="filepond--panel-bottom filepond--panel-root" style="transform: translate3d(0px, 68px, 0px);"></div></div><span class="filepond--assistant" id="filepond--assistant-spzwsu972" role="status" aria-live="polite" aria-relevant="additions"></span><fieldset class="filepond--data"></fieldset><div class="filepond--drip"></div></div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="">Tell us about your services</label>
                                <textarea class="form-control profile-form-field email-field-props border-light border-radius-sm" maxlength="2000" id="exampleFormControlTextarea1"
                                          rows="6"></textarea>
                                <small id="helpId" class="text-muted">The more details the better!</small>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-6">
                <ul>
                    <li>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="" id="" maxlength="" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder=""
                                   aria-describedby="helpId">
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <label class="d-block" for="">Phone Number</label>
                            <input type="text" name="" id="" class="form-control profile-form-field email-field-props border-light border-radius-sm input-sm" maxlength="5" placeholder=""
                                   aria-describedby="helpId">
                            <input type="text" name="" id="" class="form-control profile-form-field email-field-props border-light border-radius-sm input-md" maxlength="20" placeholder=""
                                   aria-describedby="helpId">
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <div class=" text-center my-5">
        <a  class="btn btn-veedros-new btn-veedros-md border-0 mx-auto ">
                        <span class="mx-3 text-white">Let's Cooperate</span>
                    </a>
            <small id="helpId" class="text-muted my-2 d-block">We're grateful for you reaching out to us. We'll contact you as soon as possible.</small>
        </div>
        </div>
    </section>
@endsection

@section('libraryJS')
    <!-- Owl js -->
    <script src="owlCarousel/js/owl.carousel.min.js"></script>
    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('customJS')
    <script>
        $(".owl-carousel").owlCarousel({
            rewind: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            nav: true,
            dotsEach: true,
            dots: true,
            responsive: {
                1200: {
                    items: 2
                },
                992: {
                    items: 1
                },
                768: {
                    items: 1
                },
                0: {
                    items: 1
                }
            },
            autoplayHoverPause: true
        });



        FilePond.parse(document.body);
        // We register the plugins required to do
        // image previews, cropping, resizing, etc.
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
        );



        // Select the file input and use
        // create() to turn it into a pond
        FilePond.create(
            document.querySelector('.filepond'),
            {
                labelIdle: `Drag & Drop your CV or <span class="filepond--label-action">Browse</span>`,
                styleLoadIndicatorPosition: 'bottom',
                styleButtonRemoveItemPosition: 'bottom',
                stylePanelLayout: 'compact',
                acceptedFileTypes: ['application/pdf'],
            }
        );
    </script>
@endsection
