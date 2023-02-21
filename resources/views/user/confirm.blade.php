@include('user._partials.header')

<nav class="header-seat p-3">
    <div class="left">
        <a href="{{ url("film/{$film->film_id}/seat/{$schedules->schedule_id}/".base64_encode($schedules->time_selected)) }}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>

    <div class="pageTitle">
        <h6>{{ $film->title }}</h6>
        <p class="mb-0">{{ $txtSchedules }} WIB</p>
    </div>
    <div class="right">
    </div>
</nav>

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content">
            <div class="my-4 px-4">
                <form method="POST" action="{{ url('film/' . $film->film_id . '/seat/' . $schedules->schedule_id . '/'.base64_encode($schedules->time_selected).'/proses') }}" class="row">
                    @csrf

                    <div class="col-lg-7 col-xl-8 pe-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="text-title">Payment Method</span>
                            </div>
                            <div class="card-body">
                                <ul class="container-layanan">
                                    @foreach($paymentList as $payment)
                                        <li class="list-payment">
                                            <div class="form-section-payment" id="Class_{{ $payment->payment_id }}">
                                                <input type="radio" name="payment" id="payment_{{ $payment->payment_id }}" value="{{ $payment->payment_id }}" style="
                                                    width: 100%;
                                                    height: 100%;
                                                    position: absolute;
                                                    top: 0;
                                                    z-index: 10;
                                                    cursor: pointer;
                                                    opacity: 0;
                                                ">

                                                <div class="form-section-logo">
                                                    <div class="wrapper">
                                                        <img id="payment" src="{{ url('assets/user/img/payment/' . $payment->icon) }}" alt="{{ $payment->name }}" style="filter: grayscale(100%);">
                                                    </div>
                                                </div>
                                                <div class="form-section-info">
                                                    <div class="price" id="{{ $payment->payment_id }}"></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4">
                        <div class="booking-summary">
                            <h4 class="title">booking summary</h4>
                            <ul>
                                <li>
                                    <h6 class="subtitle">{{ $film->title }}</h6>
                                    <span class="info">{{ $schedules->type }}</span>
                                </li>
                                <li>
                                    <h6 class="subtitle">Scheduled For</h6>
                                    <span class="info">{{ $txtSchedules }} WIB</span>
                                </li>
                                
                                @php
                                    function printSeatInfo($seatType, $seatCount, $seatPrice, &$totalPrice) {
                                        if($seatCount > 0) {
                                            $totalSeatPrice = $seatPrice * $seatCount;
                                            $totalPrice += $totalSeatPrice;
                                            echo "<li>";
                                            echo "<h6 class='subtitle'><span>{$seatType}</span></h6>";
                                            echo "<div class='info'><span>Rp ". number_format($seatPrice, 0, ',', '.') . ",- x {$seatCount} seat</span> <span>Rp ". number_format($totalSeatPrice, 0, ',', '.') . ",-</span></div>";
                                            echo "</li>";
                                        }
                                    }

                                    $totalPrice = 0;
                                @endphp

                                <ul>
                                    {{ printSeatInfo('Economy', $selectedSeat['Economy'], $economyPrice, $totalPrice) }}
                                    {{ printSeatInfo('Executive', $selectedSeat['Executive'], $executivePrice, $totalPrice) }}
                                    {{ printSeatInfo('Sweetbox', $selectedSeat['Sweetbox'], $sweetboxPrice, $totalPrice) }}
                                </ul>
                            </ul>
                            <ul class="side-shape">
                                <li>
                                    <h6 class="subtitle"><span>seat booking</span></h6>
                                    <span class="info"><span>
                                        @php
                                        $arrSeats = [];
                                        $i = 0;
                                        foreach($seats as $items) :
                                            foreach($items as $seat) :
                                                echo $i > 0 ? ', ' : '';
                                                echo $seat;

                                                $arrSeats[] = $seat;

                                                $i++;
                                            endforeach;
                                        endforeach;
                                        @endphp
                                        <input type="hidden" name="arrSeats" value="{{ json_encode($arrSeats) }}">
                                    </span></span>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    @php
                                    $tax = round(($totalPrice / 100) * 10);
                                    @endphp

                                    <span class="info"><span>price total</span><span>Rp {{ number_format($totalPrice, 0, ',', '.') }},-</span></span>
                                    <span class="info"><span>tax (10%)</span><span>Rp {{ number_format($tax, 0, ',', '.') }},-</span></span>
                                </li>
                            </ul>
                        </div>

                        <div class="proceed-area text-center">
                            <h6 class="subtitle"><span>Amount Payable</span><span>Rp {{ number_format($totalPrice + $tax, 0, ',', '.') }},-</span></h6>
                            <div class="d-grid gap-2">
                                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                <input type="hidden" name="tax" value="{{ $tax }}">

                                @foreach($seats as $row => $items)
                                    @foreach($items as $seat)
                                        <input type="hidden" name="seat[{{ $row }}][]" value="{{ $seat }}">
                                    @endforeach
                                @endforeach

                                <button type="submit" class="btn btn-primary">PROCEED TO PAY</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user._partials.js')

<script>
$( function() {
    $('[name=payment]').change( function() {
        $('.form-section-payment').removeClass('active');
        $('[name=payment]:checked').parent().addClass('active');
    });
});
</script>