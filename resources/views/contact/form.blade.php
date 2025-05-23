@include('partials.header')

<form method="POST" action="{{ route('contact.submit') }}">
    @csrf

    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email address</label>
    <input type="email" name="email" id="email" required>

    <label for="subject">Subject</label>
    <input type="text" name="subject" id="subject">

    <label for="message">Message</label>
    <textarea name="message" id="message" rows="5" required></textarea>

    <button type="submit">Send</button>
</form>
