<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">HTML Course</h1>
        <a href="{{ route('account.dashboard') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Dashboard
        </a>
    </nav>

    <!-- Course Options -->
    <div class="flex flex-col items-center justify-center h-screen -mt-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('course.html.videos') }}" class="bg-blue-600 px-6 py-4 text-white rounded-lg hover:bg-blue-800">
                🎥 Watch Videos
            </a>
            <a href="{{ route('course.html.notes') }}" class="bg-green-600 px-6 py-4 text-white rounded-lg hover:bg-green-800">
                📄 View Notes
            </a>
            <a href="{{ route('course.html.theory') }}" class="bg-yellow-600 px-6 py-4 text-white rounded-lg hover:bg-yellow-800">
                📚 Read Theory
            </a>
        </div>
    </div>

</body>
</html>




