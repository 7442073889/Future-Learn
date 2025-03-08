<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Theory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <div class="flex justify-end mb-6">
        <a href="{{ route('course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Courses
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6 text-center">📄 HTML Theory & PDFs</h1>

    <ul class="list-disc pl-8 space-y-3">
        @foreach ($theory as $item)
            <li class="bg-gray-800 p-4 rounded-lg shadow-lg flex justify-between items-center">
                <span>{{ $item->title }}</span>
                @if ($item->content)
                    <a href="{{ asset('storage/' . $item->content) }}" target="_blank" 
                        class="bg-blue-500 px-4 py-2 text-white rounded hover:bg-blue-600 transition">
                        📄 View PDF
                    </a>
                @endif
            </li>
        @endforeach
    </ul>

</body>
</html>

