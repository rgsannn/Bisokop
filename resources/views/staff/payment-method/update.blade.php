<form method="POST" action="{{ url('staff/payment-method/updateProcess/' .$paymentMethod->payment_id) }}" class="modal-content" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Update Payment Method #{{ $paymentMethod->payment_id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-1">
            <img id="preview-icon" src="{{ url('assets/user/img/payment/' . $paymentMethod->icon) }}" style="max-width: 90%;object-fit: scale-down;max-height: 75px;" class="rounded mb-2">
            <label class="form-label d-block">Icon</label>
            <input type="file" class="form-control" name="icon" data-preview="preview-icon">
        </div>
        <div class="mb-1">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $paymentMethod->name }}" />
        </div>
        <div class="mb-1">
            <label class="form-label">Account Number</label>
            <input type="text" class="form-control" name="account_number" value="{{ $paymentMethod->account_number }}" />
        </div>
        <div class="mb-1">
            <label class="form-label">Account Name</label>
            <input type="text" class="form-control" name="account_name" value="{{ $paymentMethod->account_name }}" />
        </div>
        <div class="mb-1">
            <label class="form-label">Status</label>
            <select name="status" class="select2 w-100">
                <option value="Active" {{ $paymentMethod->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Not Active" {{ $paymentMethod->status == 'Not Active' ? 'selected' : '' }}>Not Active</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Payment Method</button>
    </div>
</form>
<script src="{{ url('assets/staff') }}/js/scripts/forms/form-select2.min.js"></script>
<script src="{{ url('assets/staff') }}/js/scripts/forms/pickers/form-pickers.min.js"></script>

<script>
    $( function() {
        $('[name=icon]').change( function() {
            const reader = new FileReader();
            reader.onload = function(ev) {
                $('#preview-icon').attr('src', ev.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#preview-icon').removeClass('d-none');
        });
    });
</script>