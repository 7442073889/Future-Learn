<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="/js/app.js" defer></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto mt-10 p-6">
        <h1 class="text-2xl font-bold text-center">Live Chat</h1>

        <div id="chatBox" class="mt-5 bg-gray-800 p-4 rounded-lg h-80 overflow-y-scroll">
            <ul id="messagesList"></ul>
        </div>

        <form id="chatForm" class="mt-4">
            <input type="text" id="messageInput" placeholder="Type a message..." class="w-full p-2 rounded-lg bg-gray-700 text-white">
            <button type="submit" class="w-full mt-2 bg-purple-500 p-2 rounded-lg">Send</button>
        </form>
    </div>

    <script>
   document.getElementById('chatForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let messageInput = document.getElementById('messageInput');
        let message = messageInput.value;
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!message.trim()) {
            alert("Message cannot be empty!");
            return;
        }

        fetch("{{ route('send.message') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Message Sent:", data);
            messageInput.value = ''; // Clear input after sending
        })
        .catch(error => console.error("Fetch Error:", error));
    });

    function fetchMessages() {
    fetch("{{ route('get.messages') }}")
        .then(response => response.json())
        .then(data => {
            let messagesList = document.getElementById('messagesList');
            messagesList.innerHTML = ''; // Clear previous messages

            if (data.messages.length === 0) {
                messagesList.innerHTML = '<li class="p-2 text-gray-400">No messages yet...</li>';
            } else {
                data.messages.forEach(msg => {
                    let username = msg.user ? msg.user.name : 'Unknown User';
                    messagesList.innerHTML += `<li class="p-2"><strong>${username}:</strong> ${msg.message}</li>`;
                });
            }
        })
        .catch(error => console.error("Fetch Error:", error));
}

fetchMessages();
setInterval(fetchMessages, 3000);



</script>


</body>
</html>
