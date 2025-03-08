<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <div class="flex justify-end mb-6">
        <a href="{{ route('course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Dashboard
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6 text-center">📄 HTML Notes</h1>

    <ul class="list-disc pl-8 space-y-3">
        @if(empty($notes))
            <li class="bg-gray-800 p-4 rounded-lg shadow-lg text-center text-gray-400">No notes available</li>
        @else
            @foreach ($notes as $note)
                <li class="bg-gray-800 p-4 rounded-lg shadow-lg">{{ $note }}</li>
            @endforeach
        @endif
    </ul>

</body>
</html>
