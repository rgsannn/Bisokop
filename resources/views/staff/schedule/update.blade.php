<form method="POST" action="{{ url('staff/schedule/updateProcess/' .$schedules->schedule_id) }}" class="modal-content">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Update Ticket Schedules #{{ $schedules->schedule_id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label">Date</label>
            <input type="text" id="fp-default" name="date" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="{{ $schedules->date }}" />
        </div>

        <div class="mb-1">
            <label class="form-label">Time</label>
            <div id="time-fields">
                @foreach(json_decode($schedules->time, true) as $i => $times)
                <div class="input-group mb-2" id="input-{{ $i }}">
                    <input type="text" id="fp-time-{{ $i }}" name="times[]" class="form-control flatpickr-time text-start time-input" placeholder="HH:MM" value="{{ $times }}" />
                    <button type="button" class="btn btn-danger remove-time-btn" onclick="removeRow(<?= $i ?>)">Remove</button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary add-time-btn">Add Time</button>
        </div>

        <div class="mb-1">
            <label class="form-label">Theather</label>
            <select name="theater_id" id="theater-{{ $schedules->schedule_id }}" class="select2 w-100">
                @foreach($allTheater as $theater)
                <option value="{{ $theater->theater_id }}" {{ $theater->theater_id == $schedules->theater_id ? 'selected' : '' }}>{{ $theater->type }} - {{ $theater->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-1">
            <label class="form-label">Film</label>
            <select name="film_id" id="film-{{ $schedules->schedule_id }}" class="select2 w-100">
                @foreach($allFilm as $film)
                <option value="{{ $film->film_id }}" {{ $film->film_id == $schedules->film_id ? 'selected' : '' }}>{{ $film->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Ticket Schedules</button>
    </div>
</form>
<script src="{{ url('assets/staff') }}/js/scripts/forms/form-select2.min.js"></script>
<script src="{{ url('assets/staff') }}/js/scripts/forms/pickers/form-pickers.min.js"></script>

<script>
    var i = <?= count(json_decode($schedules->time, true)) ?>;
    $(function() {

        $('.add-time-btn').click(function() {
            $('#time-fields').append(`
            <div class="input-group mb-2" id="input-${i}">
                <input type="text" id="fp-time-${i}" name="times[]" class="form-control flatpickr-time text-start time-input" placeholder="HH:MM" />
                <button type="button" class="btn btn-danger remove-time-btn" onclick="removeRow(${i})">Remove</button>
            </div>
        `);
            $('#fp-time-' + i).flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 30
            });

            i++;
        });

        if ($('#time-fields').children().length == 1) {
            $('.remove-time-btn').attr('disabled', true);
        }
    });

    function removeRow(id) {
        $('#input-' + id).remove();
        if ($('#time-fields').children().length == 1) {
            $('.remove-time-btn').attr('disabled', true);
        }
    }

</script>