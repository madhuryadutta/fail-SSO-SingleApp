// resources/views/tickets/index.blade.php

@if (Auth::check())
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <a href="{{ route('tickets.create') }}">Create New Ticket</a>

    <ul>
        @foreach($tickets as $ticket)
            <li>{{ $ticket->title }} - {{ $ticket->description }}</li>
        @endforeach
    </ul>
@else
    <h1>You are not logged in. <a href="https://auth.yourdomain.com/login">Click here to log in</a></h1>
@endif
