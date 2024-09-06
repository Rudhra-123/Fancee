@extends('layouts.back-end.app')

@section('title', 'Video Messages')

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0">
                <img src="{{ dynamicAsset('public/assets/back-end/img/video_messages.png') }}" class="mb-1 mr-1" alt="">
                {{ isset($videomsg) ? 'Update Video Message' : 'Add Video Message' }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-10">
                <div class="card">
                    <div class="card-body text-start">
                        <form action="{{ isset($videomsg) ? route('admin.videomsg.update', ['id' => $videomsg->id]) : route('admin.videomsg.add') }}" method="POST">
                            @csrf
                            @if(isset($videomsg))
                                <input type="hidden" name="id" value="{{ $videomsg->id }}">
                            @endif

                            <ul class="nav nav-tabs w-fit-content mb-4">
                                @foreach($language as $lang)
                                    <li class="nav-item text-capitalize">
                                        <span class="nav-link form-system-language-tab cursor-pointer {{ $lang == $defaultLanguage ? 'active' : '' }}" id="{{ $lang }}-link">
                                            {{ getLanguageName($lang) . ' (' . strtoupper($lang) . ')' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            @foreach($language as $lang)
                                <?php
                                $translate = [];
                                if (isset($videomsg) && count($videomsg['translations'])) {
                                    foreach ($videomsg['translations'] as $translation) {
                                        if ($translation->locale == $lang) {
                                            if ($translation->key == "heading") {
                                                $translate[$lang]['heading'] = $translation->value;
                                            }
                                            if ($translation->key == "message") {
                                                $translate[$lang]['message'] = $translation->value;
                                            }
                                        }
                                    }
                                }
                                ?>
                                
                                <div class="form-group {{ $lang != $defaultLanguage ? 'd-none' : '' }} form-system-language-form" id="{{ $lang }}-form">
                                    <label class="title-color" for="heading-{{ $lang }}">Heading ({{ strtoupper($lang) }})</label>
                                    <input type="text" name="heading[]" class="form-control" id="heading-{{ $lang }}" placeholder="Enter heading" value="{{ $lang == $defaultLanguage ? $videomsg->heading ?? '' : ($translate[$lang]['heading'] ?? '') }}" {{ $lang == $defaultLanguage ? 'required' : '' }}>
                                </div>

                                <div class="form-group {{ $lang != $defaultLanguage ? 'd-none' : '' }} form-system-language-form" id="{{ $lang }}-form">
                                    <label class="title-color" for="message-{{ $lang }}">Message ({{ strtoupper($lang) }})</label>
                                    <textarea name="message[]" class="form-control" id="message-{{ $lang }}" rows="3" placeholder="Enter message" {{ $lang == $defaultLanguage ? 'required' : '' }}>
                                        {{ $lang == $defaultLanguage ? $videomsg->message ?? '' : ($translate[$lang]['message'] ?? '') }}
                                    </textarea>
                                </div>

                                <input type="hidden" name="lang[]" value="{{ $lang }}" id="lang-{{ $lang }}">
                            @endforeach

                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn px-4 btn-secondary">Reset</button>
                                <button type="submit" class="btn px-4 btn--primary">{{ isset($videomsg) ? 'Add' : 'Add' }}</button>
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
