@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">{{ $allPaymentMethod->count() }}</h2>
                    <p class="card-text">Total Payment Method</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="airplay" class="font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Payment Method</h4>
                @if($user->role === 'Cashier')
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Add" class="btn btn-primary">Add New Data</a>
                    <div class="modal fade" id="Add" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="POST" action="{{ url('staff/payment-method/addProcess') }}" class="modal-content" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Add Payment Method</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <img id="preview-gambar" src="" style="max-width: 90%;object-fit: scale-down;max-height: 75px;" class="rounded mb-2">
                                        <label class="form-label d-block">Icon</label>
                                        <input type="file" class="form-control" name="icon" data-preview="preview-gambar">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Name</label>
                                        <input type="name" class="form-control" name="name" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Account Number</label>
                                        <input type="text" class="form-control" name="account_number" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Account Name</label>
                                        <input type="text" class="form-control" name="account_name" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Payment Method</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="SannTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Payment ID</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Data</th>
                                <th class="text-nowrap">Icon</th>
                                <th class="text-nowrap">Status</th>
                                @if($user->role === 'Cashier')
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allPaymentMethod as $i => $payment)
                            <tr>
                                <td class="text-nowrap">{{ $payment->payment_id }}</td>
                                <td class="text-nowrap">{{ $payment->name }}</td>
                                <td class="text-nowrap">
                                    <div class="d-flex flex-column">
                                        <span class="text-truncate">{{ $payment->account_number }}</span>
                                        <small class="text-truncate text-primary">{{ $payment->account_name }}</small>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <img src="{{ url('assets/user/img/payment/' . $payment->icon) }}" alt="" width="100px">
                                </td>
                                <td class="text-nowrap">{{ $payment->status }}</td>
                                @if($user->role === 'Cashier')
                                    <td class="text-center text-nowrap">
                                        <a href="javascript:;" onclick="getModal('{{ url('staff/payment-method/update/'. $payment->payment_id) }}')" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:deleteSwal(`{{ url('staff/payment-method/delete/' . $payment->payment_id) }}`);" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-danger">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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

<script>
    $( function() {
        $('[name=icon]').change( function() {
            const reader = new FileReader();
            reader.onload = function(ev) {
                $('#preview-gambar').attr('src', ev.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#preview-gambar').removeClass('d-none');
        });

        $('#SannTable').DataTable({
            "order": []
        });
    });
</script>