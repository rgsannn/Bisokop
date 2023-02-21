@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content">
            <div class="my-4 px-4">
                <div class="row">
                    <div class="col-lg-7 col-xl-8 pe-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="text-title">Payment Information</span>
                            </div>
                            <div class="card-body">
                                @if(time() > strtotime('+10 minutes', strtotime($transactions->created_at)))
                                    <div class="alert alert-danger mb-0">
                                        The payment status expires, then the transaction status is cancelled.
                                    </div>
                                @else
                                    <div class="alert alert-secondary mb-0 pb-0">
                                        <div class="row">
                                            <div class="col-auto mx-auto text-center">
                                                <div height="100%" width="50" style="border-radius:2.5px" class="bg-white p-1 mb-2">
                                                    <img src="{{ url('assets/user/img/payment/' . $transactions->paymentMethod->icon) }}" class="img-fluid" width="150px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center fw-bold mb-2">
                                            Transfer To : <br>
                                            <span class="fs-5">{{ $transactions->paymentMethod->account_number }} A/n {{ $transactions->paymentMethod->account_name }}</span>
                                        </div>
                                        <div class="text-center text-danger fw-bold mb-2">
                                            Please Transfer Before :<br>
                                            {{ $transactions->dateExpiredFormat() }} WIB
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4">
                        <div class="booking-summary">
                            <h4 class="title">booking summary</h4>
                            <ul>
                                <li>
                                    <h6 class="subtitle">{{ $transactions->schedules->film->title }}</h6>
                                    <span class="info">{{ $transactions->schedules->theater->type }}</span>
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
                                <li>
                                    <span class="info"><span>price total</span><span>Rp {{ number_format($transactions->price, 0, ',', '.') }},-</span></span>
                                    <span class="info"><span>tax (10%)</span><span>Rp {{ number_format($transactions->tax, 0, ',', '.') }},-</span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="proceed-area text-center">
                            <h6 class="subtitle {{ $transactions->confirmation_transfer == 1 ? 'mb-0' : '' }}"><span>Amount Payable</span><span>Rp {{ number_format($transactions->price + $transactions->tax, 0, ',', '.') }},-</span></h6>
                            @if($transactions->confirmation_transfer == 0)
                                <div class="d-grid gap-2">
                                    <a href="javascript:;" onclick="confirmationTransfer()" class="btn btn-primary">CONFIRMATION TRANSFER</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('user._partials.footer')
    </div>
</div>
@include('user._partials.js')
<script>
    function confirmationTransfer() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Have you made a payment?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "{{ url('confirm-payment/' . $transactions->transaction_id . '/proses') }}"
            }
        })
    }
</script>