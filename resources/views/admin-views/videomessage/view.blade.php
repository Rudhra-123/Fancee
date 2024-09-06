@extends('layouts.back-end.app')

@section('title', translate('video_message'))

@php
    $predefinedMessages = [
        'en' => 'This is an English message.',
        'hi' => 'यह एक हिंदी संदेश है।',
        'bn' => 'এটি একটি বাংলা বার্তা।',
        
    ];

    // Get the languages from your application logic
    $languages = ['en', 'hi', 'bn', 'te', 'mr', 'ta', 'gu', 'ur', 'kn', 'ml', 'or', 'pa', 'as', 'bh', 'sa'];
@endphp

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/video_message.png') }}" alt="">
                {{ translate('video_message_setup') }}
            </h2>
        </div>

        {{-- <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.videomsg.store') }}" method="post" class="text-start" id="videoMessageForm">
                            @csrf

                            <div class="form-group">
                                <label for="language" class="title-color">{{ translate('select_language') }}</label>
                                <select id="language" name="language" class="form-control" required onchange="updateMessage()">
                                    <option value="" disabled selected>{{ translate('select_language') }}</option>
                                    @foreach($languages as $lang)
                                        <option value="{{ $lang }}">{{ getLanguageName($lang) }} ({{ strtoupper($lang) }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="title-color" for="heading">{{ translate('video_message_heading') }}<span class="text-danger">*</span></label>
                                <input type="text" name="heading" class="form-control" id="heading" placeholder="{{ translate('enter_video_message_heading') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="title-color mt-3" for="message">{{ translate('video_message') }}<span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" id="message" placeholder="{{ translate('enter_video_message') }}" rows="5" required></textarea>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-end mt-3">
                                <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ translate('video_message_list') }}
                                    <span class="badge badge-soft-dark radius-50 fz-12">{{ $videomsgs->total() }}</span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue" class="form-control" placeholder="{{ translate('search_by_video_message') }}" aria-label="Search orders" value="{{ request('searchValue') }}" required>
                                        <button type="submit" class="btn btn--primary">{{ translate('search') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ translate('SL') }}</th>
                                        <th class="text-center">{{ translate('video_message_heading') }}</th>
                                        <th class="text-center">{{ translate('video_message') }}</th>
                                        <th class="text-center">{{ translate('language') }}</th>
                                        <th class="text-center">{{ translate('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videomsgs as $key => $videomsg)
                                        <tr>
                                            <td>{{ $videomsgs->firstItem() + $key }}</td>
                                            <td class="text-center">{{ translate($videomsg['heading']) }}</td>
                                            <td class="text-center">{{ translate($videomsg['message']) }}</td>
                                            <td class="text-center">{{ translate($videomsg['language']) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn" title="{{ translate('edit') }}" href="{{ route('admin.videomsg.update', $videomsg['id']) }}">
                                                        <i class="tio-add"></i>
                                                    </a>
                                                    {{-- <a class="btn btn-outline-danger btn-sm videomsg-delete-button square-btn" title="{{ translate('delete') }}" id="{{ $videomsg['id'] }}">
                                                        <i class="tio-delete"></i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $videomsgs->links() !!}
                        </div>
                    </div>

                    @if(count($videomsgs) == 0)
                        @include('layouts.back-end._empty-state', ['text' => 'no_video_message_found'], ['image' => 'default'])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <span id="route-admin-videomsg-delete" data-url="{{ route('admin.videomsg.delete') }}"></span>
@endsection

@push('script')
    <script>
        const predefinedMessages = @json($predefinedMessages);

        function updateMessage() {
            const language = document.getElementById('language').value;
            document.getElementById('heading').value = ''; // Clear previous value
            document.getElementById('message').value = predefinedMessages[language] || ''; // Set predefined message

            // You can add additional logic here to fetch and set heading based on language if needed
        }
    </script>
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/products-management.js') }}"></script>
@endpush
