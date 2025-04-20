<h1>Messages</h1>

@if($messages->isEmpty())
    <p>There are no messages yet.</p>
@else
    @foreach($messages as $message)
        <div>
            <p><strong>{{ $message->name }} ({{ $message->email }})</strong></p>

            @if($message->subject)
                <p><strong>Onderwerp:</strong> {{ $message->subject }}</p>
            @endif

            <p>{{ $message->message }}</p>

            <p>Sent at {{ $message->created_at->format('d-m-Y H:i') }}</p>
            <hr>
        </div>
    @endforeach
@endif
