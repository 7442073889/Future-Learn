<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentPage = 1;
        const coursesPerPage = 6;

        @php
            $courses = [
                ['title' => 'HTML Basics', 'video' => 'qz0aGYrrlhU'],
                ['title' => 'HTML for Beginners', 'video' => 'BsDoLVMnmZs'],              
                ['title' => 'HTML Crash Course', 'video' => 'UB1O30fR-EE'],
                ['title' => 'HTML & CSS Grid Layouts', 'video' => 't6CBKf8K_Ac'],
                ['title' => 'Building Forms with HTML', 'video' => 'tp8JIuCXBaU'],      
                ['title' => 'HTML API Integration', 'video' => 'f7AU2Ozu8eo'],
                ['title' => 'Mastering HTML Elements', 'video' => 'upDLs1sn7g4'],
                ['title' => 'HTML Responsive Design', 'video' => 'HGTJBPNC-Gw'],
                ['title' => 'HTML5 New Features', 'video' => 'aJmK0jU8wBk'],
                ['title' => 'HTML Best Practices', 'video' => '2Ja-JWgMlhg']
            ];
        @endphp

        let courses = {!! json_encode($courses) !!};
        const totalPages = Math.ceil(courses.length / coursesPerPage);
        const coursesContainer = document.getElementById("courses-container");
        const paginationContainer = document.getElementById("pagination");
        const modal = document.getElementById("video-modal");
        const modalContent = document.getElementById("modal-content");
        const closeModal = document.getElementById("close-modal");

        function renderCourses() {
            coursesContainer.innerHTML = "";
            const start = (currentPage - 1) * coursesPerPage;
            const end = start + coursesPerPage;
            const currentCourses = courses.slice(start, end);

            currentCourses.forEach((course, index) => {
                const courseCard = `
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl relative">
                        <div class="bg-gray-700 h-32 flex items-center justify-center text-gray-300 text-xl font-semibold">
                            ${course.title}
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-white">${course.title}</h3>
                            <p class="text-sm text-gray-400 mt-2">Learn ${course.title} with hands-on examples and real-world projects.</p>
                            <button onclick="openModal('${course.video}')" class="bg-blue-500 text-white px-4 py-2 w-full rounded mt-4 hover:bg-blue-600 transition">
                                Watch Now
                            </button>
                            <button onclick="deleteCourse(${index})" class="bg-red-500 text-white px-4 py-2 w-full rounded mt-2 hover:bg-red-600 transition">
                                ❌ Delete Video
                            </button>
                        </div>
                    </div>
                `;
                coursesContainer.innerHTML += courseCard;
            });
        }

        function renderPagination() {
            paginationContainer.innerHTML = "";
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement("button");
                pageBtn.innerText = i;
                pageBtn.classList = `px-4 py-2 mx-1 rounded ${i === currentPage ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300'}`;
                pageBtn.onclick = () => {
                    currentPage = i;
                    renderCourses();
                    renderPagination();
                };
                paginationContainer.appendChild(pageBtn);
            }
        }

        window.openModal = function(videoId) {
            modal.style.display = "block";
            modalContent.innerHTML = `<iframe width="100%" height="400" src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" allowfullscreen></iframe>`;
        }

        closeModal.onclick = function() {
            modal.style.display = "none";
            modalContent.innerHTML = "";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                modalContent.innerHTML = "";
            }
        }

        window.deleteCourse = function(index) {
            courses.splice(index, 1);
            renderCourses();
            renderPagination();
        }

        document.getElementById("add-video-form").onsubmit = function(event) {
            event.preventDefault();
            const title = document.getElementById("video-title").value;
            const videoId = document.getElementById("video-id").value;
            if (title && videoId) {
                courses.push({ title, video: videoId });
                document.getElementById("video-title").value = "";
                document.getElementById("video-id").value = "";
                renderCourses();
                renderPagination();
            }
        };

        renderCourses();
        renderPagination();
    });
    </script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">HTML Course - Admin Panel</h1>
        <a href="{{ route('admin.course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900">
            ⬅ Back to Dashboard
        </a>
    </nav>

    <div class="container mx-auto p-6">
        
        <h1 class="text-3xl font-bold mb-6 text-center">HTML Courses</h1>

        <!-- Add Video Form -->
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

        <!-- Video Grid -->
        <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

        <!-- Pagination -->
        <div id="pagination" class="flex justify-center mt-6"></div>
    </div>

    <!-- Video Modal -->
    <div id="video-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-2xl relative">
            <span id="close-modal" class="absolute top-4 right-4 text-white text-2xl cursor-pointer">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>

</body>
</html>
