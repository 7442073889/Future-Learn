<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Video Lessons</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <!-- Navigation -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Courses
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6 text-center">🎥 HTML Video Lessons</h1>

    <!-- ✅ Video Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($videos as $video)
            <div class="bg-gray-800 rounded-lg shadow-lg p-4">
                <h3 class="text-xl font-semibold text-white mb-2">{{ $video->title }}</h3>
                <iframe width="100%" height="200" 
                    src="https://www.youtube.com/embed/{{ $video->content }}" 
                    frameborder="0" allowfullscreen class="rounded-lg">
                </iframe>
            </div>
        @endforeach
    </div>

</body>
</html>



