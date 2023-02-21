@include('user._partials.header')

<nav class="header-seat p-3">
    <div class="left">
        <a href="{{ url('film/' . $film->film_id) }}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <h6>{{ $film->title }}</h6>
        <p class="mb-0">{{ $txtSchedules }} WIB</p>
    </div>
    <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogBasic">
            <ion-icon name="time-outline"></ion-icon>
        </a>
    </div>
</nav>
<div class="content-box" style="background: #333545">
    <form method="POST" action="{{ url('film/' . $film->film_id . '/seat/' . $schedules->schedule_id . '/'.base64_encode($schedules->time_selected).'/confirm') }}" class="content-page mx-0 px-0">
        @csrf

        <div class="content">
            <div class="seatlayout-main-wrapper float-left">
                <div class="container container-seat px-0">
                    <div class="seat-full-container">
                        <div class="seat-lay-economy-wrapper float-left">
                            <div class="seat-lay-economy-heading mt-0 float-left">
                                <h3>SCREEN {{ $schedules->theater->type }}</h3>
                            </div>
                            <div class="screen">
                                <img src="{{ asset('user/img/screen.png') }}">
                            </div>
                        </div>
                        <div class="seat-lay-economy-wrapper float-left">
                            @foreach ($allRow as $row)
                                @if (!is_null($row))
                                    <div class="seat-lay-economy-heading float-left">
                                        <h3>{{ $row->type }} Rp {{ number_format($row->price, 0, ',', '.') }}</h3>
                                    </div>

                                    @php 
                                        $rowItem = collect(json_decode($row->row, true))->sortDesc(); 
                                    @endphp
                                    
                                    @foreach($rowItem as $item)
                                        <div class="seat-lay-row float-left">
                                            <ul>
                                                @for($i = 1; $i <= 22; $i++)
                                                    @php $seat = $item . $i; @endphp

                                                    <style>
                                                        .seat-lay-row #{{ $seat }}[type="checkbox"]+label:before {
                                                            content: "{{ $i }}";
                                                        }
                                                    </style>

                                                    @if ($i == 1) 
                                                        <li class="seat-heading-row">{{ $item }}</li>
                                                    @endif

                                                    @if ($i == 5 || $i == 19) 
                                                        </ul><ul class="seat-second-row">
                                                    @endif

                                                    <li class="{{ $row->type == 'Sweetbox' ? 'sweetbox' : '' }} {{ in_array($seat, $bookedSeats) || $row->disabled ? 'seat-disable' : '' }}">
                                                        <input type="checkbox" id="{{ $seat }}" name="seat[{{ $row->id }}][]" value="{{ $seat }}" onchange="setSelectedSeat(`{{ $seat }}`, {{ $row->price }}, {{ $row->type == 'Sweetbox' ? '1' : '0' }})" {{ in_array($seat, $bookedSeats) || $row->disabled ? 'disabled' : '' }}>
                                                        <label for="{{ $seat }}" class="{{ $row->type == 'Sweetbox' ? 'sweetbox' : '' }}"></label>
                                                    </li>

                                                    @if ($i === 22)
                                                        </ul><ul class="seat-last-row"><li class="seat-heading-row">{{ $item }}</li></ul>
                                                    @endif
                                                @endfor
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyrights px-4 py-4" style="background: #333545;border-top: 1px solid rgba(255, 255, 255, 0.11);">
            <div class="container">
                <div class="row gy-2 align-items-center">
                    <div class="col-sm-5 col-md-4 text-light">
                        <h6>You Have Choosed Seat</h6>
                        
                        <div id="selected-seat-list"></div>
                    </div>
                    <div class="col-sm-7 col-md-8 text-end">
                        <h6 class="text-light">Total Rp <span id="total-price"></span></h6>
                        <button type="submit" class="btn btn-primary">PROCEED TO PAY</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@include('user._partials.js')

<div class="modal fade" tabindex="-1" id="DialogBasic" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silver Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="movie-schedule justify-content-start">
                    @php
                        $current_time = strtotime(date('Y-m-d H:i'));
                        $time = collect(json_decode($schedules->time, true)); 
                    @endphp
                    @foreach($time as $times)
                        @php
                            $show_time = strtotime(date("{$schedules->date} {$times}"));
                            $disabled_class = $show_time < $current_time ? 'disabled' : '';
                            $active_class = $times == $schedules->time_selected ? 'active' : '';
                            $link_url = $show_time < $current_time ? 'javascript:;' : url("film/{$film->film_id}/seat/{$schedules->schedule_id}/".base64_encode($times));
                        @endphp

                        <a class="item {{ $disabled_class }} {{ $active_class }} me-2" href="{{ $link_url }}">
                            {{ $times }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const MAX_SEAT = 6;
let SELECTED_SEAT = [];
let TOTAL_HARGA = 0;

function rp(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

function showSelectedSeat(seat, isSweetbox) {
    $('#selected-seat-list').append(`
        <div class="selected-seat me-2 ${ isSweetbox == 1 ? 'sweetbox' : '' }" id="selected-${seat}">
            <div class="item">
                <style>.selected-seat .item .seat#S_${seat}:before {content: "${seat}";}</style>
                <div class="seat" id="S_${seat}"></div>
            </div>
        </div>
    `);
}

function setSelectedSeat(seat, price, isSweetbox) {
    const $el = $('#' + seat);
    if ($el.prop('checked')) {
        if (SELECTED_SEAT.length >= MAX_SEAT) {
            alert(`Anda hanya dapat memilih maksimal ${MAX_SEAT} seat.`);
            $el.prop('checked', false);
            return;
        }

        TOTAL_HARGA += Number(price);
        SELECTED_SEAT.push({ seat, isSweetbox });
        showSelectedSeat(seat, isSweetbox);

        if (isSweetbox === 1) {
            const seatNumber = Number(seat.slice(1));
            const row = seat[0];
            
            for (let i = 1; i < 2; i++) {
                const selectedSeatNumber = seatNumber % 2 == 1 ? seatNumber + i : seatNumber - i;
                const selectedSeat = row + selectedSeatNumber.toString();
                
                TOTAL_HARGA += Number(price);
                $('#' + selectedSeat).prop('checked', true);
                SELECTED_SEAT.push({ seat: selectedSeat, isSweetbox });
                showSelectedSeat(selectedSeat, isSweetbox);
            }
        }
    } else {
        TOTAL_HARGA -= Number(price);
        $(`#selected-${seat}`).remove();

        if (isSweetbox) {
            const seatNumber = Number(seat.slice(1));
            const row = seat[0];

            for (let i = 1; i < 2; i++) {
                const selectedSeatNumber = seatNumber % 2 == 1 ? seatNumber + i : seatNumber - i;
                const selectedSeat = row + selectedSeatNumber.toString();
                
                TOTAL_HARGA -= Number(price);
                $('#' + selectedSeat).prop('checked', false);
                SELECTED_SEAT = SELECTED_SEAT.filter(value => value.seat !== selectedSeat);
                $(`#selected-${selectedSeat}`).remove();
            }
        }

        SELECTED_SEAT = SELECTED_SEAT.filter(value => value.seat !== seat);
    }

    $('#total-price').text(rp(TOTAL_HARGA));

}
</script>