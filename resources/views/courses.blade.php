@extends('layout')


@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/player.css">
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection


@section('content')

    <div class="new-bg" style="z-index: -1; opacity: 0.25"></div>
<section class="my-5 py-5">

    <div class="container mt-5" id="course-info">
        <h1>
            Hey, {{explode(' ',Auth::user()->name)[0]}}!
        </h1>
        <div class="my-5 py-5">
            <h2>Here are some stats about your courses!</h2>
            <div class="row">
                <div class="col-sm-4">
                    <canvas id="subscriptions" width="30px" height="30px"></canvas>
                    <h3 class="text-muted mt-3 text-center">Subscriptions</h3>
                </div>
                <div class="col-sm-4">
                    <canvas id="views" width="30px" height="30px"></canvas>
                    <h3 class="text-muted mt-3 text-center">Total views</h3>
                </div>
                <div class="col-sm-4">
                    <canvas id="revenue" width="30px" height="30px"></canvas>
                    <h3 class="text-muted mt-3 text-center">Revenue in EGP</h3>
                </div>
            </div>
        </div>
        <div class="w-100 my-5">
            <div class="card course-card development-card noJquery mx-auto">
                <div class="card-body m-0">
                    <a href="{{route('manage.courses.new')}}" class="card-body-inner noscroll card-bg-img"  >
                        <div class="play-circle play-circle-05"> <i data-feather="plus"></i></div>
                        <h4 class="card-title title-mine">
                            Create a new course.
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        @if(Auth::user()->instructor->courses->count() > 0)
            <h2 class="mb-2">Here are your current courses:</h2>
            <div class="row">
                <div class="col-12">
                    <div class="course-cards-container row py-3">
                        @foreach(Auth::user()->instructor->courses as $course)
                            <div class="col-lg-4">

                                <div class="card course-card development-card noJquery"
                                     style="background-image: url('{{$course->img}}')">
                                    <div class="card-body m-0">
                                        <a href="{{asset('/manage/instructor/courses/') ."/" . $course->slug}}" class="card-body-inner noscroll card-bg-img"  >
                                            <div class="play-circle play-circle-0"> <i data-feather="edit"></i> </div>
                                            <h4 class="card-title title-mine">
                                                {{$course->name}}
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        </div>

</section>
@endsection
@section('customJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('subscriptions').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            responsive:true,
            maintainAspectRatio: false,
            data: {
                labels: ['4/28/2020', '4/29/2020', '4/30/2020', '5/1/2020', '5/2/2020', '5/3/2020'],
                datasets: [{
                    label: 'Subscriptions',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx2 = document.getElementById('views').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            responsive:true,
            maintainAspectRatio: false,
            data: {
                labels: ['4/28/2020', '4/29/2020', '4/30/2020', '5/1/2020', '5/2/2020', '5/3/2020'],
                datasets: [{
                    label: 'Enrolled',
                    data: [30, 56, 12, 84, 70, 158],
                    backgroundColor: [
                        '#8C00F122',
                    ],
                    borderColor: [
                        '#8C00F1',
                    ],
                    borderWidth: 2
                },
                    {
                        label: 'Not enrolled',
                        data: [30, 65, 22, 156, 345, 370],
                        backgroundColor: [
                            '#65D3BF22',
                        ],
                        borderColor: [
                            '#65D3BF',
                        ],
                        borderWidth: 2
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx3 = document.getElementById('revenue').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            responsive:true,
            maintainAspectRatio: false,
            data: {
                labels: ['4/28/2020', '4/29/2020', '4/30/2020', '5/1/2020', '5/2/2020', '5/3/2020'],
                datasets: [{
                    label: 'Revenue (in EGP)',
                    data: [450, 820, 250, 1540, 1200, 670],
                    backgroundColor: [
                        '#FD982722',
                        '#FD982722',
                        '#FD982722',
                        '#FD982722',
                        '#FD982722',
                        '#FD982722',
                    ],
                    borderColor: [
                        '#FD9827',
                        '#FD9827',
                        '#FD9827',
                        '#FD9827',
                        '#FD9827',
                        '#FD9827',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
