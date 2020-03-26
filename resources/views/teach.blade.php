@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
    <link rel="stylesheet" href="{{asset('styles/teach.css')}}">
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
    <div class="teach-header teach-with-us-content">
        <h1 class="text-center">We know <br> how it works</h1>
        <h4 class="text-center">We'll give you a hand with <br> your content</h4>
    </div>
    <section class="my-5 header">
        <section class="carousel">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="review-carousel owl-carousel owl-theme w-100">
                        @for($i = 0; $i<10; $i++)
                            <div class="carousel-column">
                                @for($j = 0; $j<1; $j++)
                                    <div class="review p-3 mx-2 my-4 ">
                                        <div class="user-info row py-3">
                                            <div class="tip-instructor-avatar col-lg-2 ml-4 ">
                                                <img src="{{asset('images')}}/05.jpg" alt="" class="round">
                                            </div>
                                            <div class="rating-container ml-2 col-lg-8 d-flex flex-column justify-content-center">
                                                <h6 class="m-0">Ahmed Zakii</h6>
                                                <div class="d-flex ratings col-6 px-0 m-0">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequatur ea et, expedita facilis inventore labore molestias officia praesentium quasi qui quidem repellat repellendus rerum sapiente sequi soluta totam voluptas.</div>
                                    </div>
                                @endfor
                            </div>
                        @endfor







                    </div>
                </div>

            </div>
            <!-- style="background-image: url('images/01.png')" -->

        </section>

        <div class="row justify-content-end m-auto w-50">


            <div class="teach-with-us-content my-5">
                <div class="container">
                    <h1>Have <br> content !</h1>
                    <br>
                    <h2>If you...</h2>
                    <h4><img class=" mr-2" src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how to organize your content.</h4>
                    <h4><img class=" mr-2" src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how/where to start.</h4>
                    <h4><img class=" mr-2" src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how to promote your vision.</h4>
                    <br>
                    <h4>We can give you a hand with that!</h4>
                </div>


            </div>

        </div>
    </section>
    <section class="my-5 teach-form">
        <div class="row">
            <div class="col-12 form-bg col-lg-6">
                <div class="form-overlay"></div>
                <div class="form-content w-100 m-5">
                    <ul>
                        <li>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="" id="" maxlength="100" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Your Name"
                                       aria-describedby="helpId">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="" id="" maxlength="" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="example@example.com"
                                       aria-describedby="helpId">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label class="d-block" for="">Phone Number</label>
                                <input type="text" name="" id="" class="form-control profile-form-field email-field-props border-light border-radius-sm" maxlength="11"
                                       placeholder="01xxxxxxxxx" aria-describedby="helpId">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="">Resume/CV</label>
                                <input type="file"
                                       class="filepond"
                                       name="img"
                                       accept="application/pdf"/>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="">Tell us about your project</label>
                                <textarea class="form-control profile-form-field email-field-props border-light border-radius-sm" maxlength="2000"
                                          rows="6" placeholder="Tell us more about your course"></textarea>
                                <small id="helpId" class="text-muted">The more details the better!</small>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-12 d-none-sm col-lg-6">

                <img class="" style="transform: scaleX(-1);" src="images/Teach-960x775.jpg" alt="">


            </div>
        </div>
        <div class=" text-center my-5">
                <a  class="btn btn-veedros-new  btn-veedros-md border-0 mx-auto ">
                        <span class="mx-3 text-white">Confirm</span>
                    </a>
                    <small class="text-muted">we're so grateful to reach here, wait for our call as soon as possible</small>
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
