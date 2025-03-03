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
                ['title' => 'Advanced HTML5', 'video' => '2PWKoB5hIeo'],
                ['title' => 'HTML & SEO Optimization', 'video' => 'viRJcfNX6lg'],
                ['title' => 'Responsive HTML Design', 'video' => 'eog0e_9SoRk'],
                ['title' => 'HTML for Beginners', 'video' => 'BsDoLVMnmZs'],
                ['title' => 'Forms & Validations in HTML', 'video' => 'E3XxeJHzGfY'],
                ['title' => 'HTML5 & Multimedia', 'video' => 'WbyS4OsB9Wk'],
                ['title' => 'HTML Best Practices', 'video' => 'jKB1a9AglQk'],
                ['title' => 'HTML & Email Templates', 'video' => 'k8Z3fD6b7jM'],
                ['title' => 'HTML Crash Course', 'video' => 'UB1O30fR-EE'],
                ['title' => 'HTML & CSS Grid Layouts', 'video' => 't6CBKf8K_Ac'],
                ['title' => 'Building Forms with HTML', 'video' => 'tp8JIuCXBaU'],
                ['title' => 'HTML & SVG Graphics', 'video' => 'GxlrBdDr5H8'],
                ['title' => 'HTML Animations & Effects', 'video' => 'e4TYvF1h_bM'],
                ['title' => 'HTML & Bootstrap', 'video' => '91Q6RvKvd7s'],
                ['title' => 'HTML Semantics & Accessibility', 'video' => 'zyZK4oAM4B0'],
                ['title' => 'HTML API Integration', 'video' => 'f7AU2Ozu8eo'],
                ['title' => 'HTML for Web Apps', 'video' => 'N9nucZcOlpA'],
                ['title' => 'HTML5 Game Development', 'video' => 'q5I3K4Yk5nk'],
                ['title' => 'Mastering HTML Elements', 'video' => 'upDLs1sn7g4']
            ];
        @endphp

        const courses = {!! json_encode($courses) !!};
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

            currentCourses.forEach(course => {
                const courseCard = `
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <div class="bg-gray-700 h-32 flex items-center justify-center text-gray-300 text-xl font-semibold">
                            ${course.title}
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-white">${course.title}</h3>
                            <p class="text-sm text-gray-400 mt-2">Learn ${course.title} with hands-on examples and real-world projects.</p>
                            <button onclick="openModal('${course.video}')" class="bg-blue-500 text-white px-4 py-2 w-full rounded mt-4 hover:bg-blue-600 transition">
                                Watch Now
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

        renderCourses();
        renderPagination();
    });
    </script>
</head>
<body class="bg-gray-900 text-white">

    <div class="container mx-auto p-6">
        
        <div class="mb-6">
            <a href="{{ route('account.dashboard') }}" class="text-blue-400 hover:text-blue-600 text-lg flex items-center">
                ⬅ Back to Dashboard
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6 text-center">HTML Courses</h1>

        <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

        <div id="pagination" class="flex justify-center mt-6"></div>
    </div>

    <div id="video-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-2xl relative">
            <span id="close-modal" class="absolute top-4 right-4 text-white text-2xl cursor-pointer">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>

</body>
</html>




