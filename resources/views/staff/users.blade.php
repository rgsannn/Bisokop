@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">{{ $allUsers->count() }}</h2>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="SannTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap">User ID</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Register</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allUsers as $users)
                                <tr>
                                    <td class="text-nowrap">{{ $users->user_id }}</td>
                                    <td class="text-nowrap">{{ $users->email }}</td>
                                    <td class="text-nowrap">{{ $users->name }}</td>
                                    <td class="text-nowrap">{{ $users->dateFormat() }} WIB</td>
                                    <td class="text-center text-nowrap">
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Update-{{ $users->user_id }}" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:deleteSwal(`{{ url('staff/users/delete/' . $users->user_id) }}`);" class="btn btn-icon">
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

                @foreach($allUsers as $users)
                    <div class="modal fade" id="Update-{{ $users->user_id }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="POST" action="{{ url('staff/users/updateProcess/' . $users->user_id) }}" class="modal-content">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Update Users #{{ $users->email }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $users->email }}" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $users->name }}" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Password Users</label>
                                        <div class="input-group form-password-toggle">
                                            <input type="password" name="password" class="form-control" placeholder="Enter if you want to change the password users!" id="basic-default-password" />
                                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Users</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('staff._partials.footer')

<script>
    $(document).ready(function() {
        $('#SannTable').DataTable({
            "order": []
        })
    });
</script>