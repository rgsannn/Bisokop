@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">{{ $allTheater->count() }}</h2>
                    <p class="card-text">Total Theater</p>
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
                <h4 class="card-title">Data Theater</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Add" class="btn btn-primary">Add New Data</a>
                <div class="modal fade" id="Add" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form method="POST" action="{{ url('staff/theater/addProcess') }}" class="modal-content">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Add Theater</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label class="form-label">Name Theater</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Type</label>
                                    <select id="" class="select2 w-100" name="type">
                                        <option value="0">-- Select Theater Type</option>
                                        <option value="Silver Class">Silver Class</option>
                                        <option value="Gold Class">Gold Class</option>
                                        <option value="Platinum Class">Platinum Class</option>
                                    </select>
                                </div>
                                
                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#economy" aria-controls="economy" aria-selected="false">Economy</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#executive" aria-controls="executive" aria-selected="true">Executive</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#sweetbox" aria-controls="sweetbox" aria-selected="false">Sweetbox</button>
                                    </li>
                                </ul>
                                <div class="nav-align-top nav-tabs-shadow">
                                    <div class="tab-content">
                                    @foreach(['economy', 'executive', 'sweetbox'] as $class)
                                        @php
                                            $price = ($class == 'economy') ? 25000 : ($class == 'executive' ? 30000 : 35000);
                                            $selected = ($class == 'economy') ? ["I", "J"] : ($class == 'executive' ? ["B", "C", "D", "E", "F", "G", "H"] : ["A"]);
                                        @endphp
                                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="{{ $class }}" role="tabpanel">
                                            <div class="mb-1">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price_{{ $class }}" value="{{ $price }}" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                                <select class="select2 form-select" id="normalMultiSelect0{{ $loop->iteration }}" name="row_{{ $class }}[]" multiple="multiple">
                                                    @foreach(range('A', 'J') as $char)
                                                        <option {{ in_array($char, $selected) ? 'selected' : '' }}>{{ $char }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Theater</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="SannTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap">ID Theater</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allTheater as $i => $theater)
                                <tr>
                                    <td class="text-nowrap">{{ $theater->theater_id }}</td>
                                    <td class="text-nowrap">{{ $theater->name }}</td>
                                    <td class="text-nowrap">{{ $theater->type }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="javascript:;" onclick="getModal('{{ url('staff/theater/update/'. $theater->theater_id) }}')" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:deleteSwal(`{{ url('staff/theater/delete/' . $theater->theater_id) }}`);" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-danger">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </a>
                                    </td>
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
    $(document).ready(function() {
        $('#SannTable').DataTable({
            "order": []
        });
    });
</script>