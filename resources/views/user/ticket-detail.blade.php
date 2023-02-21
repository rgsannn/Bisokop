@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content">
            <div class="my-4 px-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="booking-summary">
                            <h4 class="title text-success">YOUR BOOKING IS CONFIRMED!</h4>
                            <ul>
                                <li>
                                    <h6 class="subtitle">{{ $transactions->schedules->film->title }}</h6>
                                    <span class="info">{{ $transactions->schedules->theater->type }} - {{ $transactions->schedules->theater->name }}</span>
                                </li>
                                <li>
                                    <h6 class="subtitle">Scheduled For</h6>
                                    <span class="info">{{ date('d M Y', strtotime($transactions->schedules->date)) }}, {{ $transactions->time }} WIB</span>
                                </li>
                                
                                @foreach(['Economy', 'Executive', 'Sweetbox'] as $type)
                                    @if($selectedSeat[$type]['count'] > 0)
                                        @php
                                            $totalPrice = $selectedSeat[$type]['price'];
                                            $pricePerSeat = $totalPrice / $selectedSeat[$type]['count'];
                                        @endphp

                                        <li>
                                            <h6 class="subtitle"><span>{{ $type }}</span></h6>
                                            <div class="info"><span>Rp {{ number_format($pricePerSeat, 0, ',', '.') }},- X {{ $selectedSeat[$type]['count'] }}</span> <span>Rp {{ number_format($totalPrice, 0, ',', '.') }},-</span></div>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>

                            <ul class="side-shape">
                                <li>
                                    <h6 class="subtitle"><span>seat booking</span></h6>
                                    <span class="info"><span>
                                        {{ implode(', ', json_decode($transactions->seats)) }}
                                    </span></span>
                                </li>
                            </ul>

                            <ul>
                                <li class="mb-2">
                                    <h6 class="subtitle mb-0"><span>Paymen Method</span><span>{{ $transactions->paymentMethod->name }}</span></h6>
                                </li>
                                <li class="mb-2">
                                    <h6 class="subtitle mb-0"><span>Total Amount</span><span>Rp {{ number_format($transactions->price + $transactions->tax, 0, ',', '.') }},-</span></h6>
                                </li>
                                <li>
                                    <h6 class="subtitle mb-0"><span>order Date</span><span>{{ $transactions->dateFormat() }} WIB</span></h6>
                                </li>
                            </ul>
                        </div>
                        <div class="proceed-area text-center">
                            <h6 class="subtitle mb-0"><span>Booking ID</span><span>{{ $transactions->booking_id }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('user._partials.footer')
    </div>
</div>
@include('user._partials.js')