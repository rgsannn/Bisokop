@include('staff._partials.header')

<div class="row">
    <div class="col-lg-12">
        <form method="POST" action="{{ url('staff/films/addProcess') }}" class="card" enctype="multipart/form-data">
            @csrf

            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Add Data Film</h4>
            </div>
            <div class="row card-body">
                <div class="col-md-6 mb-1">
                    <img id="preview-thumbnail" src="" style="max-width: 90%;object-fit: scale-down;max-height: 150px;" class="rounded mb-2 d-none">
                    <label class="form-label d-block">Thumbnail</label>
                    <input type="file" class="form-control" name="thumbnail" data-preview="preview-gambar-001" />
                    <small class="text-danger">Allowed file types: png, jpg, jpeg.</small>
                </div>

                <div class="col-md-6 mb-1">
                    <img id="preview-cover" src="" style="max-width: 90%;object-fit: scale-down;max-height: 150px;" class="rounded mb-2 d-none">
                    <label class="form-label d-block">Cover</label>
                    <input type="file" class="form-control" name="cover" data-preview="preview-gambar-001" />
                    <small class="text-danger">Allowed file types: png, jpg, jpeg.</small>
                </div>

                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">Movie Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
                </div>
                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">Director</label>
                    <input type="text" class="form-control" name="director" value="{{ old('director') }}" />
                </div>
                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">Genre</label>
                    <input type="text" class="form-control" name="genre" value="{{ old('genre') }}" />
                </div>
                <div class="col-md-2 mb-1">
                    <label class="form-label d-block">Rating</label>
                    <select name="rating" class="select2 w-100">
                        <option value="">-- Select Rating</option>
                        <option value="0" {{ old('rating') == '0' ? 'selected' : '' }}>0</option>
                        <option value="0.5" {{ old('rating') == '0.5' ? 'selected' : '' }}>0.5</option>
                        <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1</option>
                        <option value="1.5" {{ old('rating') == '1.5' ? 'selected' : '' }}>1.5</option>
                        <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2</option>
                        <option value="2.5" {{ old('rating') == '2.5' ? 'selected' : '' }}>2.5</option>
                        <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3</option>
                        <option value="3.5" {{ old('rating') == '3.5' ? 'selected' : '' }}>3.5</option>
                        <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4</option>
                        <option value="4.5" {{ old('rating') == '4.5' ? 'selected' : '' }}>4.5</option>
                        <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5</option>
                    </select>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="form-label d-block">Age Rating</label>
                    <select name="age_rating" class="select2 w-100">
                        <option value="">-- Select Age Rating</option>
                        <option value="SU" {{ old('age_rating') == 'SU' ? 'selected' : '' }}>SU</option>
                        <option value="R 13+" {{ old('age_rating') == 'R 13+' ? 'selected' : '' }}>R 13+</option>
                        <option value="R 17+" {{ old('age_rating') == 'R 17+' ? 'selected' : '' }}>R 17+</option>
                        <option value="R 18+" {{ old('age_rating') == 'R 18+' ? 'selected' : '' }}>R 18+</option>
                        <option value="R 21+" {{ old('age_rating') == 'R 21+' ? 'selected' : '' }}>R 21+</option>
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">Duration</label>
                    <input type="text" class="form-control" name="duration" value="{{ old('duration') }}" />
                </div>
                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">URL Trailers</label>
                    <input type="text" class="form-control" name="url_trailer" value="{{ old('url_trailer') }}" />
                </div>
                <div class="col-md-4 mb-1">
                    <label class="form-label d-block">Status</label>
                    <select name="status" class="form-control w-100">
                        <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        <option value="unpublish" {{ old('status') == 'unpublish' ? 'selected' : '' }}>Unpublish</option>
                    </select>
                </div>
                <div class="col-md-12 mb-1">
                    <label class="form-label d-block">Description</label>
                    <textarea type="text" class="form-control" rows="6" name="description">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Add Data</button>
            </div>
        </form>
    </div>
</div>

@include('staff._partials.footer')

<script>
    $( function() {
        $('[name=thumbnail]').change( function() {
            const reader = new FileReader();
            reader.onload = function(ev) {
                $('#preview-thumbnail').attr('src', ev.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#preview-thumbnail').removeClass('d-none');
        });
        
        $('[name=cover]').change( function() {
            const reader = new FileReader();
            reader.onload = function(ev) {
                $('#preview-cover').attr('src', ev.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#preview-cover').removeClass('d-none');
        });
    });
</script>