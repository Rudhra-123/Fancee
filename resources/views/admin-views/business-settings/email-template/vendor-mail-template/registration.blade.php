<div class="p-3 px-xl-4 py-sm-5">
    <div class="text-center">
        <img width="100" class="mb-4" id="view-mail-icon"
             src="{{$template['image'] ? dynamicStorage('storage/app/public/email-template/'.$template['image']) : dynamicAsset(path: 'public/assets/back-end/img/email-template/registration-success.png')}}"
             alt="">
        <h3 class="mb-3 view-mail-title text-capitalize">
            {{$title}}
        </h3>
    </div>
    <div class="view-mail-body">
        {!! $body !!}

        {{-- <body>
            <h1>{{ translate('You have received a video message') }}</h1>
            <p>{{ translate('Please click the button below to download the video message.') }}</p>
            <a href="{{ $downloadLink }}" style="padding: 10px 20px; background-color: #1a73e8; color: white; text-decoration: none; border-radius: 5px;">{{ translate('Download Video') }}</a>
        </body> --}}
    </div>
    <hr>
    @include('admin-views.business-settings.email-template.partials-design.footer')
</div>
