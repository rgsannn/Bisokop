@include('staff._partials.header')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="fw-bolder mb-0">{{ $allFilms->count() }}</h2>
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
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Film</h4>
                <a href="<?= url('staff/films/add') ?>" class="btn btn-primary">Add New Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="SannTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Film ID</th>
                                <th class="text-nowrap">Movie Title</th>
                                <th class="text-nowrap">Genre</th>
                                <th class="text-nowrap">Director</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allFilms as $i => $film)
                                <tr>
                                    <td class="text-nowrap">{{ $film->film_id }}</td>
                                    <td class="text-nowrap">{{ $film->title }}</td>
                                    <td class="text-nowrap">{{ $film->genre }}</td>
                                    <td class="text-nowrap">{{ $film->director }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="<?= url('staff/films/update/' . $film->film_id) ?>" class="btn btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:deleteSwal(`{{ url('staff/films/delete/' . $film->film_id) }}`);" class="btn btn-icon">
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
        })
    });
</script>