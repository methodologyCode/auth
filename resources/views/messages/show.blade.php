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

    .message-container {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        text-align: center;
    }

    .sender {
        font-weight: bold;
        color: #333;
    }

    .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .tab {
        margin-right: 20px;
        cursor: pointer;
        font-size: 18px;
    }

    .tab.active {
        font-weight: bold;
    }
</style>

<div class="container">

    <h1>Мои сообщения</h1>

    <div class="tabs">
        <div class="tab"
             onclick="showMessages('sent')">Sent Messages</div>
        <div class="tab"
             onclick="showMessages('received')">Received Messages</div>
    </div>

    <div id="sent-messages" style="display: block;">
        <h2>Отправленные</h2>
        @foreach($sentMessages as $message)
            <div class="message-container">
                <p class="sender">To: {{ $message->receiver->name }}</p>
                <p>Message: {{ $message->content }}</p>
            </div>
        @endforeach
    </div>

    <div id="received-messages" style="display: none;">
        <h2>Полученные</h2>
        @foreach($receivedMessages as $message)
            <div class="message-container">
                <p class="sender">From: {{ $message->sender->name }}</p>
                <p>Message: {{ $message->content }}</p>
            </div>
        @endforeach
    </div>

    <div>
        <a href="/home">Вернуться назад</a>
    </div>

    <script>
        function showMessages(tab) {
            const sentMessages = document.getElementById('sent-messages');
            const receivedMessages = document.getElementById('received-messages');

            sentMessages.style.display = tab === 'sent' ? 'block' : 'none';
            receivedMessages.style.display = tab === 'received' ? 'block' : 'none';

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(element => element.classList.remove('active'));

            const activeTab = document.querySelector('.tab.' + tab);
            activeTab.classList.add('active');
        }
    </script>

</div>

@endsection