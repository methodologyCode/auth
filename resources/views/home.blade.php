@extends('layouts.app')

@section('content')

<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-top: 50px;
    }

    h1, h2, p {
        margin-bottom: 20px;
    }

    form {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 5px;
        text-align: left;
    }

    input, textarea, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    a {
        color: #3498db;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">

    <h1>Welcome, {{ Auth::user()->name }}</h1>

    <p><a href="/">Home</a></p>

    <h2>Messages</h2>

    <form action="{{ route('send.message') }}" method="post">
        {{ csrf_field() }}
        <div>
            <label for="receiver_username">Receiver Username:</label>
            <select name="receiver_username" required>
            @foreach($existingUsers as $user)
                @if($user->id !== Auth::id())
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div>
            <label for="content">Message:</label>
            <textarea name="content" required></textarea>
        </div>
        <button type="submit">Send Message</button>
    </form>

    <p><a href="{{ route('show.messages') }}">View Messages</a></p>

</div>

@endsection