@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">{{ $allSchedule->count() }}</h2>
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

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Ticket Schedules</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Add" class="btn btn-primary">Add New Data</a>
                <div class="modal fade" id="Add" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form method="POST" action="{{ url('staff/schedule/addProcess') }}" class="modal-content">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Add Ticket Schedules</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label class="form-label">Date</label>
                                    <input type="text" id="fp-default" name="date" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Time</label>
                                    <div id="time-fields-add">
                                        <div class="input-group mb-2" id="input-0">
                                            <input type="text" id="fp-time-0" name="times[]" class="form-control flatpickr-time text-start time-input" placeholder="HH:MM" />
                                            <button type="button" class="btn btn-danger remove-time-btn" onclick="removeRow(0)" disabled>Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary add-times-btn">Add Time</button>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Theather</label>
                                    <select name="theater_id" id="theater" class="select2 w-100">
                                        <option value="">-- Select Theather</option>
                                        @foreach($allTheater as $theater)
                                        <option value="{{ $theater->theater_id }}">{{ $theater->type }} - {{ $theater->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Film</label>
                                    <select name="film_id" id="film" class="select2 w-100">
                                        <option value="">-- Select Film</option>
                                        @foreach($allFilm as $film)
                                        <option value="{{ $film->film_id }}">{{ $film->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Ticket Schedules</button>
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
                                <th class="text-nowrap">Schedule ID</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Time</th>
                                <th class="text-nowrap">Theather</th>
                                <th class="text-nowrap">Film</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allSchedule as $i => $schedule)
                            <tr>
                                <td class="text-nowrap">{{ $schedule->schedule_id }}</td>
                                <td class="text-nowrap">{{ $schedule->dateFormat() }}</td>
                                <td class="text-nowrap">{{ $schedule->time }}</td>
                                <td class="text-nowrap">{{ $schedule->theater->name }}</td>
                                <td class="text-nowrap">{{ $schedule->film->title }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="javascript:;" onclick="getModal('{{ url('staff/schedule/update/'. $schedule->schedule_id) }}')" class="btn btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <a href="javascript:deleteSwal(`{{ url('staff/schedule/delete/' . $schedule->schedule_id) }}`);" class="btn btn-icon">
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
            "order": [
                [1, 'desc']
            ]
        });
    });
    let index = <?= count(json_decode($schedule->time, true)) ?>;
    $(function() {

        $('.add-times-btn').click(function() {
            $('#time-fields-add').append(`
            <div class="input-group mb-2" id="input-${index}">
                <input type="text" id="fp-time-${index}" name="times[]" class="form-control flatpickr-time text-start time-input" placeholder="HH:MM" />
                <button type="button" class="btn btn-danger remove-time-btn" onclick="removeRow(${index})">Remove</button>
            </div>
        `);
            $('#fp-time-' + index).flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 30
            });

            i++;
        });

        if ($('#time-fields-add').children().length == 1) {
            $('.remove-time-btn').attr('disabled', true);
        }
    });

    function removeRow(id) {
        $('#input-' + id).remove();
        if ($('#time-fields-add').children().length == 1) {
            $('.remove-time-btn').attr('disabled', true);
        }
    }
</script>