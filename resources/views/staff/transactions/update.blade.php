<form method="POST" action="{{ url('staff/transactions/updateProcess/' .$transactions->transaction_id) }}" class="modal-content">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Update Transactions #{{ $transactions->transaction_id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-1">
            <label class="form-label">Booking ID</label>
            <input type="text" class="form-control" name="booking_id" value="{{ $transactions->booking_id }}" readonly />
        </div>
        <div class="mb-1">
            <label class="form-label">Confirmation Transfer</label>
            <input type="text" class="form-control" name="confirmation_transfer" value="{{ $transactions->confirmation_transfer ? 'True' : 'False' }}" readonly />
        </div>
        <div class="mb-1">
            <label class="form-label">Status</label>
            <select name="status" class="select2 w-100">
                <option value="Waiting for payment" {{ $transactions->status == "Waiting for payment" ? 'selected' : '' }}>Waiting for payment</option>
                <option value="Payment Received" {{ $transactions->status == "Payment Received" ? 'selected' : '' }}>Payment Received</option>
                <option value="Payment Canceled" {{ $transactions->status == "Payment Canceled" ? 'selected' : '' }}>Payment Canceled</option>
            </select>
        </div>
        <div class="mb-1">
            <label class="form-label">Ticket Print</label>
            <select name="printed" class="select2 w-100">
                <option value="0" {{ $transactions->printed == 0 ? 'selected' : '' }}>False</option>
                <option value="1" {{ $transactions->printed == 1 ? 'selected' : '' }}>True</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Transactions</button>
    </div>
</form>
<script src="{{ url('assets/staff') }}/js/scripts/forms/form-select2.min.js"></script>
<script src="{{ url('assets/staff') }}/js/scripts/forms/pickers/form-pickers.min.js"></script>