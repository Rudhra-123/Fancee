@extends('layouts.back-end.app')

@section('title', 'Vimeo API Settings')

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ dynamicAsset('public/assets/back-end/img/vimeo.png') }}" alt="">
                Vimeo API Setup
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.business-settings.vimeo.update') }}" method="post" class="text-start">
                            @csrf
                            <div class="form-group">
                                <label for="vimeo_client_id">Vimeo Client ID</label>
                                <input type="text" name="vimeo_client_id" class="form-control" id="vimeo_client_id" value="{{ $vimeoClientID }}" required>
                            </div>
                            <div class="form-group">
                                <label for="vimeo_client_secret">Vimeo Client Secret</label>
                                <input type="text" name="vimeo_client_secret" class="form-control" id="vimeo_client_secret" value="{{ $vimeoClientSecret }}" required>
                            </div>
                            <div class="form-group">
                                <label for="vimeo_access_token">Vimeo Access Token</label>
                                <input type="text" name="vimeo_access_token" class="form-control" id="vimeo_access_token" value="{{ $vimeoAccessToken }}" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $vimeoAPIStatus == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $vimeoAPIStatus == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div> --}}
                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn--primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ dynamicAsset('public/assets/back-end/js/products-management.js') }}"></script>
@endpush