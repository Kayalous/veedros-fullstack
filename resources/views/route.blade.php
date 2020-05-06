@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/Route.css">
@endsection

@section('content')

    <div class="route-header">
        <div class="content">
            <h1>Welcome to Route</h1>
            <img src="{{asset('images')}}/Route_logo.png" alt="">
            <div class="mt-3">
            <a href="" class="add-cycle" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-plus"></i>
            </a>

            </div>
            
        </div>
    </div>

    <!-- <section class="avalible-sessions my-5">
    <div class="container">
        <div class="row">
            <div class="header">
                <h2>Hi, {{ explode(" ", Auth::user()->name)[0] }}</h2>
                <br>
                <p>Available sessions</p>
                <small>Please enter course's passcode to see the updates</small>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="card course-card development-card noJquery" style="background-color: #A7A7A7"
                    data-toggle="modal" data-target="#exampleModal">
                    <div class="card-body m-0">
                        <div class="card-body-inner noscroll card-bg-img">
                            <div class="form-group py-4">
                                <label for="">Passcode</label>
                                <input type="text" name="" id=""
                                    class="form-control profile-form-field m-auto border-light border-radius-sm"
                                    placeholder="" aria-describedby="helpId">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <ul>
                        <li>
                            <h3>
                                Full stack diploma
                            </h3>
                        </li>
                        <li class="my-2">
                            <p>Round 30 Alex</p>
                        </li>
                        <li>
                            <button class=" btn btn-veedros-new btn-veedros-sm border-0 m-auto" type="button">
                                Go
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->

      
    <a href="" class="add-cycle" data-toggle="modal" data-target="#exampleModalCenter">
    <i class="fas fa-plus"></i>
    </a>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Join cycle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="btn-redeem-veedros m-auto ">
            <form method="POST" action="/promo/redeem">
                <input type="hidden" name="_token" value="ptBO1JyGWqEb9ZGu0SY7hGSFpLRKvgDnl3WcQbKV">
                <input class="btn-redeem form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Enter cycle passcode..." type="text" name="code">
                <button type="submit" class="btn-redeem-icon border-0">
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</section>
@endsection

