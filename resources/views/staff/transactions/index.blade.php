@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    <p class="card-text">Revenue</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="activity" class="font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Transactions</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="SannTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Transactions ID</th>
                                <th class="text-nowrap">Booking ID</th>
                                <th class="text-nowrap">Users</th>
                                <th class="text-nowrap">Film</th>
                                <th class="text-nowrap">Theater</th>
                                <th class="text-nowrap">Payment</th>
                                @if($user->role === 'Cashier')
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allTransactions as $i => $transactions)
                                <tr>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="text-truncate">#{{ $transactions->transaction_id }}</span>
                                            <small class="text-truncate text-primary">{{ $transactions->dateFormat() }} WIB</small>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            @if($transactions->printed)
                                                <span class="badge bg-secondary mb-1">#{{ $transactions->booking_id }}</span>
                                                <span class="badge bg-secondary">Ticket Printed</span>
                                            @else
                                                @if($transactions->status !== 'Payment Received')
                                                    <span class="badge bg-secondary mb-1">#{{ $transactions->booking_id }}</span>
                                                @else
                                                    <span class="badge bg-dark mb-1">#{{ $transactions->booking_id }}</span>
                                                    @if($user->role === 'Cashier')
                                                        <button href="#!" class="border-0 badge bg-warning" onclick="PrintDiv('<?= $transactions->booking_id ?>', '<?= $transactions->schedules->film->title ?>', '<?= $transactions->schedules->theater->name ?>', '<?= $transactions->seatNumbers() ?>', '<?= $transactions->dateScheduleFormat() ?>')">Print Ticket</button>
                                                    @else
                                                        <span class="badge bg-warning">Ticket Not Used</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="text-truncate">{{ $transactions->users->name }}</span>
                                            <small class="text-truncate text-primary">{{ $transactions->users->email }}</small>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="text-truncate">{{ $transactions->schedules->film->title }}</span>
                                            <small class="text-truncate text-primary">{{ $transactions->dateScheduleFormat() }} WIB</small>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="badge bg-secondary mb-1">{{ $transactions->schedules->theater->name }}</span>
                                            <div class="d-flex gap-1">
                                                @foreach(json_decode($transactions->seats, true) as $seats)
                                                    <span class="badge bg-primary">{{ $seats }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <ul>
                                            <li>{{ $transactions->paymentMethod->name }}</li>
                                            <li>Rp {{ number_format($transactions->price + $transactions->tax, 0, ',', '.') }}</li>
                                        </ul>
                                        <div class="d-flex flex-column">
                                            <span class="badge bg-{{ $transactions->statusClass() }}">{{ $transactions->status }}</span>
                                        </div>
                                    </td>
                                    @if($user->role === 'Cashier')
                                        <td class="text-center text-nowrap">
                                            <a href="javascript:;" onclick="getModal('{{ url('staff/transactions/update/'. $transactions->transaction_id) }}')" class="btn btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('staff._partials.footer')

<div id="cetakNota" style="display: none;">
    <div class="cardWrap">
        <div class="card cardLeft">
            <h1>Bisokop</h1>
            <div class="title">
                <h2>#Film->title</h2>
                <span>movie</span>
            </div>
            <div class="name">
                <h2>#Theater->name</h2>
                <span>THEATHER</span>
            </div>
            <div class="seat">
                <h2>#Transactions->seats</h2>
                <span>seat</span>
            </div>
            <div class="time">
                <h2>#Transactions->schedules->date, #Transactions->time WIB</h2>
                <span>date, time</span>
            </div>

        </div>
        <div class="card cardRight">
            <div class="eye"></div>
            <div class="number">
                <h3>#Transactions->booking_id</h3>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#SannTable').DataTable({
            "order": []
        });
    });

    function PrintDiv(booking_id, film_title, theater_name, seats, date_time) {
        var divToPrint = document.getElementById('cetakNota');
        var popupWin = window.open('', '_blank', 'Print-Window');
        popupWin.document.open();
        popupWin.document.write(`<html><body onload="window.print()"><link rel="stylesheet" href="<?= url('assets/user/css/print.css?=' . time()) ?>"><div class="cardWrap">
        <div class="card cardLeft">
            <h1>Bisokop</h1>
            <div class="title">
                <h2>${film_title}</h2>
                <span>movie</span>
            </div>
            <div class="name">
                <h2>${theater_name}</h2>
                <span>THEATHER</span>
            </div>
            <div class="seat">
                <h2>${seats}</h2>
                <span>seat</span>
            </div>
            <div class="time">
                <h2>${date_time} WIB</h2>
                <span>date, time</span>
            </div>

        </div>
        <div class="card cardRight">
            <div class="eye"></div>
            <div class="number">
                <h3>${booking_id}</h3>
            </div>
        </div>
    </div></body></html>`);
        popupWin.document.close();
    }
</script>