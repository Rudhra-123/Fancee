{{-- <div class="content container-fluid">
    <div class="mb-3">
        <h6 class="h1 mb-0 d-flex gap-2">
            <img src="{{ dynamicAsset('public/assets/back-end/img/video_message.png') }}" alt="">
            {{ translate('video_message_setup') }}
        </h6>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user-video-messages.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="messageSelect" class="form-label">{{ translate('Select a predefined message') }}</label>
                            <select id="messageSelect" class="form-select" onchange="updateMessage()">
                                <option value="">{{ translate('Select a message') }}</option>
                                @foreach($videomsgs as $videomsg)
                                    <option value="{{ $videomsg->message }}">{{ $videomsg->heading }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="messageTextArea" class="form-label">{{ translate('Your message') }}</label>
                            <textarea id="messageTextArea" name="message" class="form-control" rows="4"></textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="heading" class="form-label">{{ translate('Message Heading') }}</label>
                            <input type="text" id="heading" name="heading" class="form-control" required>
                        </div> 
                        <button type="submit" class="btn btn-primary">{{ translate('Submit') }}</button>
                    </form>
                    <div class="text-start mt-4">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ translate('SL') }}</th>
                                        <th class="text-center">{{ translate('video_message_heading') }}</th>
                                        <th class="text-center">{{ translate('video_message') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videomsgs as $key => $videomsg)
                                        <tr>
                                            <td>{{ $videomsgs->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $videomsg->heading }}</td>
                                            <td class="text-center">{{ $videomsg->message }}</td>
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
                        @include('layouts.back-end._empty-state', ['text' => 'no_video_message_found', 'image' => 'default'])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateMessage() {
        var messageSelect = document.getElementById('messageSelect');
        var messageTextArea = document.getElementById('messageTextArea');
        messageTextArea.value = messageSelect.value;
    }
</script> --}}
