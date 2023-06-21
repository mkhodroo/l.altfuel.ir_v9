
<div class="direct-chat-messages" style="height: 500px">
    @foreach ($ticket->comments() as $comment)
            <div class="direct-chat-msg {{ ($comment->user()->id === auth()->user()->id) ? 'right' : '' }}">
                <div class="direct-chat-infos clearfix">
                
                </div>
                
                <div class="direct-chat-text">
                    <span class="direct-chat-name {{ ($comment->user()->id === auth()->user()->id) ? 'float-right' : '' }}"">{{ $comment->user()->display_name ?? '' }}</span>
                    <br>
                    {{ $comment->text ?? '' }} <br>
                    @empty(!$comment->voice)
                        <div class="green-player">
                            <audio controls>
                                <source src="{{ url("$comment->voice") }}" type="audio/wav">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @endempty
                    <span class="direct-chat-timestamp">{{ $comment->created_at }}</span>
                </div>
            </div>
            <div id="end"></div>
    @endforeach
</div>
<div class="card-body">
    @include('ATView::partial-view.add-comment-form', ['form_id' => 'comment-form', 'ticket_title' => $ticket->title])
</div>


