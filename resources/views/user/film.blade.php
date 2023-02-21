@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content">
            <section class="details-banner bg_img px-4" data-background="{{ asset('user/img/cover/' . $film->cover) }}" style="background-image: url(&quot;{{ asset('user/img/cover/' . $film->cover) }}&quot;);">
                <div class="container">
                    <div class="details-banner-wrapper">
                        <div class="details-banner-thumb">
                            <img src="{{ asset('user/img/film/' . $film->thumbnail) }}" alt="movie">
                            <a href="{{ $film->url_trailer }}" target="_blank" class="video-popup">
                                <img src="{{ asset('user/img/video-button.png') }}" alt="movie">
                            </a>
                        </div>

                        <div class="details-banner-content offset-lg-3">
                            <h3 class="title text-light">{{ $film->title }}</h3>
                            <a href="#0" class="button">{{ $film->genre }}</a>
                            <div class="tags">
                                <span>{!! nl2br($film->description) !!}</span>
                            </div>

                            <div class="social-and-duration">
                                <div class="duration-area">
                                    <div class="item">
                                        <span>{{ $film->director }}</span>
                                    </div>
                                    <div class="item">
                                        <span>{{ $film->durationFormat() }}</span>
                                    </div>
                                    <div class="item">
                                        <span>{{ $film->age_rating }}</span>
                                    </div>
                                </div>

                                <ul class="item list-inline mb-0">
                                    @php $ratingStar = $film->rating; @endphp

                                    @for($i=1; $i <= 5; $i++)
                                        @php
                                        if($ratingStar >= 1) {
                                            $classRating = 'star';
                                        } else if($ratingStar == 0.5) {
                                            $classRating = 'star-half';
                                        } else {
                                            $classRating = 'star-outline';
                                        }
                                        @endphp

                                        <li class="list-inline-item">
                                            <a class="text-sm text-warning fs-5" href="#!"><ion-icon name="{{ $classRating }}"></ion-icon></a>
                                        </li>

                                        @php $ratingStar--; @endphp
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-5 px-4">
                <div class="container">
                    <div class="offset-lg-3 text-center">
                        <div class="list-ticket owl-carousel item-carousel pt-0" style="padding: 2rem 0px;">
                            @for ($i = 0; $i < 7; $i++)
                                @php 
                                    $times = strtotime('+' . $i . ' days'); 
                                    $formattedDate = date('Y-m-d', $times);
                                    $isActive = ($date == $formattedDate || (empty($date) && $formattedDate == date('Y-m-d')));
                                @endphp
                                <div class="items">
                                    <div class="date-box {{ $isActive ? 'active' : '' }}">
                                        <a href="{{ url('film/' . $film->film_id . '/' . $formattedDate) }}">
                                            <span>{{ date('D', $times) }}</span> <br> {{ date('d', $times) }}
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        @foreach([$silverClass, $goldClass, $platinumClass] as $class)
                            @if(isset($class->schedules))
                                <div class="card mt-4 {{ $loop->first ? 'mt-xxl-1' : '' }}">
                                    <div class="card-header d-flex justify-content-between">
                                        <span>{{ $class->schedules->type }}</span>
                                        <span>Rp {{ number_format($class->priceLowest, 0, ',', '.') }} - Rp {{ number_format($class->priceHighest, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="movie-schedule justify-content-start">
                                            @php
                                                $current_time = strtotime(date('Y-m-d H:i'));
                                                $time = collect(json_decode($class->schedules->time, true)); 
                                            @endphp
                                            @foreach($time as $times)
                                                @php
                                                    $show_time = strtotime(date("{$class->schedules->date} {$times}"));
                                                    $disabled_class = $show_time < $current_time ? 'disabled' : '';
                                                    $link_url = $show_time < $current_time ? 'javascript:;' : url("film/{$film->film_id}/seat/{$class->schedules->schedule_id}/".base64_encode($times));
                                                @endphp

                                                <a class="item {{ $disabled_class }} me-3" href="{{ $link_url }}">
                                                    {{ $times }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        @include('user._partials.footer')
    </div>
</div>

@include('user._partials.js')
<script>
    $(document).ready(function() {
        $('.list-ticket').owlCarousel({
            margin: 16,
            responsive: {
                0: {
                    items: 4
                },
                480: {
                    items: 5
                },
                600: {
                    items: 6
                },
                1000: {
                    items: 10
                },
                1440: {
                    items: 12
                }
            }
        })
    })
</script>