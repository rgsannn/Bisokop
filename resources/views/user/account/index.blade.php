@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content p-4">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <span class="text-title">List Transactions</span>
                        </div>
                    </div>
                    <div class="transactions">
                        @if($transactions->count() == 0)
                            <div class="text-center">
                                <img src="https://cdni.iconscout.com/illustration/premium/thumb/sorry-item-not-found-3328225-2809510.png?f=avif" alt="">
                                <h6>No transactions yet, please place an order first</h6>
                                <a href="{{ url('') }}" class="btn btn-info btn-sm mt-2">SELECT FILM HERE</a>
                            </div>

                        @else
                            @foreach($transactions as $transaction)
                                <a href="{{ $transaction->urlDetailTransactions() }}" class="item">
                                    <div class="detail">
                                        <img src="{{ asset('user/img/film/' . $transaction->schedules->film->thumbnail) }}" alt="img" class="image-block">
                                        <div class="content">
                                            <div>
                                                <strong class="fw-bold">{{ $transaction->schedules->film->title }}</strong>
                                                <p>{{ $transaction->schedules->theater->type }} - {{ $transaction->schedules->theater->name }}</p>
                                                <p class="fw-bold">Scheduled For</p>
                                                <p>{{ date('d M Y', strtotime($transaction->schedules->date)) }}, {{ $transaction->time }} WIB</p>
                                                <p class="fw-bold">{{ count(json_decode($transaction->seats)) }} Seats Rp {{ number_format($transaction->price + $transaction->tax, 0, ',', '.') }},-</p>
                                                <p>{{ implode(', ', json_decode($transaction->seats)) }}</p>
                                                <p class="fw-bold">{{ $transaction->ticketUsed() }}</p>
                                            </div>
                                            <hr>
                                            <div class="right">
                                                <p>{{ $transaction->dateFormat() }} WIB</p>
                                                <p class="price text-{{ $transaction->statusClass() }}">{{ $transaction->status }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('user._partials.footer')
    </div>
</div>

@include('user._partials.js')