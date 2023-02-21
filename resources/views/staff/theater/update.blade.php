<form method="POST" action="{{ url('staff/theater/updateProcess/' .$theater->theater_id) }}" class="modal-content">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Update Theater #{{ $theater->theater_id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label">Name Theater</label>
            <input type="text" class="form-control" name="name" value="{{ $theater->name }}" />
        </div>
        <div class="mb-1">
            <label class="form-label">Type</label>
            <select class="select2 w-100" name="type">
                <option value="Silver Class" {{ $theater->type == 'Silver Class' ? 'selected' : '' }}>Silver Class</option>
                <option value="Gold Class" {{ $theater->type == 'Gold Class' ? 'selected' : '' }}>Gold Class</option>
                <option value="Platinum Class" {{ $theater->type == 'Platinum Class' ? 'selected' : '' }}>Platinum Class</option>
            </select>
        </div>
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#update-economy-{{ $theater->theater_id }}" aria-controls="economy" aria-selected="false">Economy</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#update-executive-{{ $theater->theater_id }}" aria-controls="executive" aria-selected="true">Executive</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#update-sweetbox-{{ $theater->theater_id }}" aria-controls="sweetbox" aria-selected="false">Sweetbox</button>
            </li>
        </ul>
        <div class="nav-align-top nav-tabs-shadow">
            <div class="tab-content">
                @foreach(['economy', 'executive', 'sweetbox'] as $class)
                @php
                $row = $theater->seatOfType($class);
                $row->row = json_decode($row->row, true);
                @endphp
                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="update-{{ $class }}-{{ $theater->theater_id }}" role="tabpanel">
                    <div class="mb-1">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price_{{ $class }}" value="{{ $row->price }}" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="normalMultiSelect">Select Seat Row</label>
                        <select class="select2 form-select" id="normalMultiSelect0{{ $loop->iteration }}{{ $theater->theater_id }}" name="row_{{ $class }}[]" multiple="multiple">
                            @foreach(range('A', 'J') as $char)
                            <option value="{{ $char }}" {{ in_array($char, $row->row) ? 'selected' : '' }}>{{ $char }}</option>
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
        <button type="submit" class="btn btn-primary">Update Theater</button>
    </div>
</form>
<script src="{{ url('assets/staff') }}/js/scripts/forms/form-select2.min.js"></script>
<script src="{{ url('assets/staff') }}/js/scripts/forms/pickers/form-pickers.min.js"></script>