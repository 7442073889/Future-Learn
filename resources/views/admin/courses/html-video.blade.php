<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - HTML Videos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">HTML Course - Admin Panel</h1>
        <a href="{{ route('admin.course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Dashboard
        </a>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">📚 Manage HTML Video Lessons</h1>

        <!-- ✅ Add New Video Form -->
        <div class="mb-6 p-4 bg-gray-800 rounded-lg">
            <h2 class="text-xl font-bold mb-2 text-white">➕ Add New Video</h2>
            <form id="add-video-form">
                <input type="text" id="video-title" placeholder="Video Title" class="w-full p-2 mb-2 bg-gray-700 text-white rounded">
                <input type="text" id="video-id" placeholder="YouTube Video ID" class="w-full p-2 mb-2 bg-gray-700 text-white rounded">
                <button type="submit" class="bg-green-500 px-4 py-2 text-white rounded w-full hover:bg-green-700">
                    Add Video
                </button>
            </form>
        </div>

        <!-- ✅ Video Grid -->
        <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($videos as $video)
                <div class="bg-gray-800 rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $video->title }}</h3>
                    <iframe width="100%" height="200" 
                        src="https://www.youtube.com/embed/{{ $video->content }}" 
                        frameborder="0" allowfullscreen class="rounded-lg">
                    </iframe>
                    <button onclick="deleteVideo({{ $video->id }})" 
                        class="bg-red-500 px-4 py-2 text-white rounded mt-2 hover:bg-red-600 transition">
                        ❌ Delete Video
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ✅ Video Modal -->
    <div id="video-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-2xl relative">
            <span id="close-modal" class="absolute top-4 right-4 text-white text-2xl cursor-pointer">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>

    <script>
        // ✅ Open Video in Modal
        window.openModal = function(videoId) {
            document.getElementById("video-modal").style.display = "block";
            document.getElementById("modal-content").innerHTML = `<iframe width="100%" height="400" 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" allowfullscreen></iframe>`;
        };

        // ✅ Close Modal
        document.getElementById("close-modal").onclick = function() {
            document.getElementById("video-modal").style.display = "none";
            document.getElementById("modal-content").innerHTML = "";
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById("video-modal")) {
                document.getElementById("video-modal").style.display = "none";
                document.getElementById("modal-content").innerHTML = "";
            }
        };

        // ✅ Add Video
        document.getElementById("add-video-form").onsubmit = async function(event) {
            event.preventDefault();
            const title = document.getElementById("video-title").value;
            const videoId = document.getElementById("video-id").value;

            if (title && videoId) {
                try {
                    let response = await fetch("{{ route('admin.course.html.video.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ title, video: videoId })
                    });

                    let result = await response.json();
                    if (result.success) {
                        location.reload();
                    } else {
                        alert("Error adding video.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            }
        };

        // ✅ Delete Video
        async function deleteVideo(id) {
            if (!confirm("Are you sure you want to delete this video?")) return;

            try {
                let response = await fetch("{{ route('admin.course.html.video.delete') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id })
                });

                let result = await response.json();
                if (result.success) {
                    location.reload();
                } else {
                    alert("Error deleting video.");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }
    </script>

</body>
</html>

