@include('staff._partials.header')

<div class="row">
    @if($user->role === 'Admin')
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalUsers, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Users</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalFilm, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Film</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="film" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalTheather, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Theather</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="airplay" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalSchedules, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Ticket Schedules</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="calendar" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                        <p class="card-text">Revenue</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="activity" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalPayment, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Payment Method</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="credit-card" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                        <p class="card-text">Revenue</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="activity" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($totalPayment, 0, ',', '.') }}</h2>
                        <p class="card-text">Total Payment Method</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="credit-card" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chart Transactions</h4>
            </div>
            <div class="card-body">
                <div id="chart-transactions"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chart Selling Seats Type</h4>
            </div>
            <div class="card-body">
                <div id="chart-seats"></div>
            </div>
        </div>
    </div>
</div>

@include('staff._partials.footer')

@php
$chartLabels = collect([]);
for($i=date('Ym01'); $i <= date('Ymt'); $i++) {
    $label = date('d M', strtotime($i));
    $chartLabels->push($label);
}

$chartLabels = json_encode($chartLabels->all());
@endphp

<script>
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');

        return ribuan;
    }
    const labelCharts = JSON.parse(`{!! $chartLabels !!}`);

    responseSeats = JSON.parse('{!! json_encode($chartSeats) !!}')
    options = {
        chart: {
            height: 350,
            type: "line",
            offsetY: 10
        },
        stroke: {
            width: [0, 0, 0],
            curve: "smooth"
        },
        plotOptions: {
            bar: {
                columnWidth: "50%"
            }
        },
        colors: ["#7D8EC4", "#48578E", "#212C58"],
        series: [{
            name: "Economy",
            type: "column",
            data: responseSeats.Economy
        }, {
            name: "Executive",
            type: "column",
            data: responseSeats.Executive
        }, {
            name: "Sweetbox",
            type: "column",
            data: responseSeats.Sweetbox
        }],
        fill: {
            type: "gradient",
            gradient: {
                inverseColors: !0,
                shade: "light",
                type: "vertical",
                shadeIntensity: 0.25,
                opacityFrom: 0.75,
                opacityTo: 0.75,
                stops: [0, 0, 0]
            }
        },
        labels: labelCharts,
        markers: {
            size: 0
        },
        legend: {
            offsetY: 10
        },
        xaxis: {
            type: "category"
        },
        tooltip: {
            shared: !0,
            intersect: !1,
            y: {
                formatter: function(e) {
                    return void 0 !== e ? formatRupiah(e.toFixed(0)) : e;
                }
            },
        },
        grid: {
            borderColor: "#f1f3fa",
            padding: {
                bottom: 20
            }
        },
    };
    const chartSeats = new ApexCharts(document.getElementById('chart-seats'), options).render();

    const responseTransactions = JSON.parse('{!! json_encode($chartTransactions) !!}');
    options = {
        chart: {
            height: 350,
            type: "line",
            offsetY: 10
        },
        stroke: {
            width: [0, 0, 0],
            curve: "smooth"
        },
        plotOptions: {
            bar: {
                columnWidth: "50%"
            }
        },
        colors: ["#28C76F", "#FF9F43", "#EA5455"],
        series: [{
            name: "Payment Success",
            type: "column",
            data: responseTransactions.success
        }, {
            name: "Waiting Payment",
            type: "column",
            data: responseTransactions.waiting
        }, {
            name: "Payment Cancelled",
            type: "column",
            data: responseTransactions.cancelled
        }],
        fill: {
            type: "gradient",
            gradient: {
                inverseColors: !0,
                shade: "light",
                type: "vertical",
                shadeIntensity: 0.25,
                opacityFrom: 0.75,
                opacityTo: 0.75,
                stops: [0, 0, 0]
            }
        },
        labels: labelCharts,
        markers: {
            size: 0
        },
        legend: {
            offsetY: 10
        },
        xaxis: {
            type: "category"
        },
        tooltip: {
            shared: !0,
            intersect: !1,
            y: {
                formatter: function(e) {
                    return void 0 !== e ? 'Rp ' + formatRupiah(e.toFixed(0)) : e;
                }
            },
        },
        grid: {
            borderColor: "#f1f3fa",
            padding: {
                bottom: 20
            }
        },
    };
    const chartTransactions = new ApexCharts(document.getElementById('chart-transactions'), options).render();
</script>