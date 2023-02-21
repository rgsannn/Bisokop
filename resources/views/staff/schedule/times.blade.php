@include('admin._partials.header')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Schedule Times</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Add" class="btn btn-primary">Add New Time</a>
                <div class="modal fade" id="Add" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form method="POST" action="{{ url('admin/schedule/' .$schedule->id_jadwal. '/times/add') }}" class="modal-content">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Add Ticket Schedules</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label class="form-label">Time</label>
                                    <input type="text" id="fp-time" name="time" class="form-control flatpickr-time text-start" placeholder="HH:MM" />
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
                                        <div class="tab-pane fade show active" id="economy" role="tabpanel">
                                            <div class="mb-1">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price_economy" value="30000" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                                <select class="select2 form-select" id="normalMultiSelect01" name="row_economy[]" multiple="multiple">
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                    <option>E</option>
                                                    <option>F</option>
                                                    <option>G</option>
                                                    <option>H</option>
                                                    <option selected>I</option>
                                                    <option selected>J</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="executive" role="tabpanel">
                                            <div class="mb-1">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price_executive" value="35000" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                                <select class="select2 form-select" id="normalMultiSelect02" name="row_executive[]" multiple="multiple">
                                                    <option>A</option>
                                                    <option selected>B</option>
                                                    <option selected>C</option>
                                                    <option selected>D</option>
                                                    <option selected>E</option>
                                                    <option selected>F</option>
                                                    <option selected>G</option>
                                                    <option selected>H</option>
                                                    <option>I</option>
                                                    <option>J</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="sweetbox" role="tabpanel">
                                            <div class="mb-1">
                                                <label class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price_sweetbox" value="45000" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                                <select class="select2 form-select" id="normalMultiSelect03" name="row_sweetbox[]" multiple="multiple">
                                                    <option selected>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                    <option>E</option>
                                                    <option>F</option>
                                                    <option>G</option>
                                                    <option>H</option>
                                                    <option>I</option>
                                                    <option>J</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Schedule Times</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Rows</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allTimes->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No data.</td>
                                </tr>
                            @endif
                            
                            @foreach($allTimes as $i => $time)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $time->jadwal->formatTanggal() }}</td>
                                    <td>{{ $time->jam }}</td>
                                    <td>
                                        @php
                                        $rows = 0;
                                        foreach($time->baris as $baris) {
                                            $rows += count(json_decode($baris->baris, true));
                                        }

                                        echo $rows;
                                        @endphp
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Update-{{ $time->id_jam }}" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:deleteSwal(`{{ url('admin/schedule/' .$schedule->id_jadwal. '/times/delete/' . $time->id_jam) }}`);" class="btn btn-icon">
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

        @foreach($allTimes as $time)
            <div class="modal fade" id="Update-{{ $time->id_jam }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form method="POST" action="{{ url('admin/schedule/' .$schedule->id_jadwal. '/times/update/' . $time->id_jam) }}" class="modal-content">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Update Ticket Schedules</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-1">
                                <label class="form-label">Time</label>
                                <input type="text" id="fp-time" name="time" class="form-control flatpickr-time text-start" placeholder="HH:MM" value="{{ $time->jam }}" />
                            </div>

                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#update-economy-{{ $time->id_jam }}" aria-controls="economy" aria-selected="false">Economy</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#update-executive-{{ $time->id_jam }}" aria-controls="executive" aria-selected="true">Executive</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#update-sweetbox-{{ $time->id_jam }}" aria-controls="sweetbox" aria-selected="false">Sweetbox</button>
                                </li>
                            </ul>
                            <div class="nav-align-top nav-tabs-shadow">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="update-economy-{{ $time->id_jam }}" role="tabpanel">
                                        @php 
                                        $rowEconomy = $time->economy();
                                        $rowEconomy->baris = json_decode($rowEconomy->baris, true); 
                                        @endphp

                                        <div class="mb-1">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price_economy" value="{{ $rowEconomy->harga }}" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                            <select class="select2 form-select" id="normalMultiSelect001" name="row_economy[]" multiple="multiple">
                                                <option {{ in_array('A', $rowEconomy->baris) ? 'selected' : '' }}>A</option>
                                                <option {{ in_array('B', $rowEconomy->baris) ? 'selected' : '' }}>B</option>
                                                <option {{ in_array('C', $rowEconomy->baris) ? 'selected' : '' }}>C</option>
                                                <option {{ in_array('D', $rowEconomy->baris) ? 'selected' : '' }}>D</option>
                                                <option {{ in_array('E', $rowEconomy->baris) ? 'selected' : '' }}>E</option>
                                                <option {{ in_array('F', $rowEconomy->baris) ? 'selected' : '' }}>F</option>
                                                <option {{ in_array('G', $rowEconomy->baris) ? 'selected' : '' }}>G</option>
                                                <option {{ in_array('H', $rowEconomy->baris) ? 'selected' : '' }}>H</option>
                                                <option {{ in_array('I', $rowEconomy->baris) ? 'selected' : '' }}>I</option>
                                                <option {{ in_array('J', $rowEconomy->baris) ? 'selected' : '' }}>J</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="update-executive-{{ $time->id_jam }}" role="tabpanel">
                                        @php 
                                        $rowExecutive = $time->executive();
                                        $rowExecutive->baris = json_decode($rowExecutive->baris, true); 
                                        @endphp

                                        <div class="mb-1">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price_executive" value="{{ $rowExecutive->harga }}" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                            <select class="select2 form-select" id="normalMultiSelect002" name="row_executive[]" multiple="multiple">
                                                <option {{ in_array('A', $rowExecutive->baris) ? 'selected' : '' }}>A</option>
                                                <option {{ in_array('B', $rowExecutive->baris) ? 'selected' : '' }}>B</option>
                                                <option {{ in_array('C', $rowExecutive->baris) ? 'selected' : '' }}>C</option>
                                                <option {{ in_array('D', $rowExecutive->baris) ? 'selected' : '' }}>D</option>
                                                <option {{ in_array('E', $rowExecutive->baris) ? 'selected' : '' }}>E</option>
                                                <option {{ in_array('F', $rowExecutive->baris) ? 'selected' : '' }}>F</option>
                                                <option {{ in_array('G', $rowExecutive->baris) ? 'selected' : '' }}>G</option>
                                                <option {{ in_array('H', $rowExecutive->baris) ? 'selected' : '' }}>H</option>
                                                <option {{ in_array('I', $rowExecutive->baris) ? 'selected' : '' }}>I</option>
                                                <option {{ in_array('J', $rowExecutive->baris) ? 'selected' : '' }}>J</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="update-sweetbox-{{ $time->id_jam }}" role="tabpanel">
                                        @php 
                                        $rowSweetbox = $time->sweetbox();
                                        $rowSweetbox->baris = json_decode($rowSweetbox->baris, true); 
                                        @endphp

                                        <div class="mb-1">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price_sweetbox" value="{{ $rowSweetbox->harga }}" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                                            <select class="select2 form-select" id="normalMultiSelect003" name="row_sweetbox[]" multiple="multiple">
                                                <option {{ in_array('A', $rowSweetbox->baris) ? 'selected' : '' }}>A</option>
                                                <option {{ in_array('B', $rowSweetbox->baris) ? 'selected' : '' }}>B</option>
                                                <option {{ in_array('C', $rowSweetbox->baris) ? 'selected' : '' }}>C</option>
                                                <option {{ in_array('D', $rowSweetbox->baris) ? 'selected' : '' }}>D</option>
                                                <option {{ in_array('E', $rowSweetbox->baris) ? 'selected' : '' }}>E</option>
                                                <option {{ in_array('F', $rowSweetbox->baris) ? 'selected' : '' }}>F</option>
                                                <option {{ in_array('G', $rowSweetbox->baris) ? 'selected' : '' }}>G</option>
                                                <option {{ in_array('H', $rowSweetbox->baris) ? 'selected' : '' }}>H</option>
                                                <option {{ in_array('I', $rowSweetbox->baris) ? 'selected' : '' }}>I</option>
                                                <option {{ in_array('J', $rowSweetbox->baris) ? 'selected' : '' }}>J</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('admin._partials.footer')