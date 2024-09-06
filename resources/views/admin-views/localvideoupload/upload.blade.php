<div class="card">
    <div class="card-body">
        <h4>Upload Video</h4>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('videos.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Video Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>

            <div class="form-group">
                <label for="video">Video File</label>
                <input type="file" name="video" class="form-control" id="video" required>
            </div>
            {{-- <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div> --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Upload to Local</button>
            </div>
        </form>
    </div>
</div>
