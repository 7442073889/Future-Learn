<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* Neon Glow */
        .neon-text {
            text-shadow: 0 0 5px #4F46E5, 0 0 10px #4F46E5, 0 0 15px #4F46E5;
        }
        
        .neon-button {
            transition: all 0.3s ease-in-out;
        }

        .neon-button:hover {
            box-shadow: 0 0 10px #4F46E5, 0 0 20px #4F46E5;
            transform: scale(1.05);
        }

        /* Smooth Transition */
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
    <!-- Top Navigation Bar -->
    <nav class="glass flex justify-between items-center p-4 mx-4 my-4">
        <h1 class="text-xl font-bold neon-text">🚀 Future Learn</h1>
        <div>
            <span class="text-gray-300 font-medium mr-4">Hello, {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Guest' }}
</span>
            <a href="{{ route('admin.logout') }}" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
        </div>
    </nav>
    
    <div class="flex">
        <!-- Sidebar -->
        <aside class="glass w-64 h-screen p-5 mx-4">
            <ul class="space-y-4">
                <li class="font-semibold text-gray-300 hover:text-purple-400 transition-all"><a href="#">📊 Dashboard</a></li>

                <!-- My Courses Dropdown -->
                <li class="font-semibold text-gray-300">
                    <button class="w-full text-left flex justify-between items-center transition-all" onclick="toggleDropdown('coursesDropdown')">
                        📚 My Courses <span>&#9662;</span>
                    </button>
                    <ul id="coursesDropdown" class="hidden pl-4 space-y-2 mt-2">
                    <li><a href="{{ route('course.html') }}" class="text-gray-400 hover:text-purple-400 transition-all">Enroll in HTML</a></li>

                    <li><a href="{{ route('course.css') }}" class="text-gray-400 hover:text-purple-400 transition-all">Enroll in CSS</a></li>

                       
                    </ul>
                </li>

                <!-- Take Quiz Dropdown -->
                <li class="font-semibold text-gray-300">
                    <button class="w-full text-left flex justify-between items-center transition-all" onclick="toggleDropdown('quizDropdown')">
                        📝 Take Quiz <span>&#9662;</span>
                    </button>
                    <ul id="quizDropdown" class="hidden pl-4 space-y-2 mt-2">
                    <li><a href="{{ route('quiz.html') }}" class="text-gray-400 hover:text-purple-400 transition-all">HTML Quiz</a></li>
                    <li><a href="{{ route('quiz.css') }}" class="text-gray-400 hover:text-purple-400 transition-all">CSS Quiz</a></li>

                        
                    </ul>
                </li>
                <li><a href="{{ route('livechat') }}" class="text-gray-400 hover:text-purple-400 transition-all">💬 Live Chat</a></li>
            </ul>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-8">
        <h2 class="text-3xl font-bold neon-text">
    🚀 Welcome to Your Dashboard {{ Auth::guard('web')->user()->name }}</h2>



            <!-- Stats Section -->
            <div class="grid grid-cols-3 gap-4 mt-6">
                <div class="glass p-6 rounded-lg">
                    <h3 class="text-xl font-semibold">📚 Enrolled Courses</h3>
                    <p class="text-gray-300 mt-2">You are enrolled in <span class="font-bold">5</span> courses.</p>
                </div>
                <div class="glass p-6 rounded-lg">
                    <h3 class="text-xl font-semibold">📝 Quizzes Taken</h3>
                    <p class="text-gray-300 mt-2">You have completed <span class="font-bold">8</span> quizzes.</p>
                </div>
            </div>

            <!-- Upcoming Courses -->
            <div class="glass p-6 rounded-lg mt-6">
                <h3 class="text-xl font-semibold">📅 Upcoming Courses</h3>
                <ul class="mt-3 space-y-2">
                    <li class="text-gray-300">🔹 Advanced JavaScript (Starts in 3 days)</li>
                    <li class="text-gray-300">🔹 Data Science with Python (Starts in 5 days)</li>
                </ul>
            </div>

            <!-- Quiz Performance -->
            <div class="glass p-6 rounded-lg mt-6">
                <h3 class="text-xl font-semibold">🏆 Your Quiz Performance</h3>
                <ul class="mt-3 space-y-2">
                    <li class="text-gray-300">✅ HTML Quiz: 85%</li>
                    <li class="text-gray-300">✅ CSS Quiz: 90%</li>
                    <li class="text-gray-300">✅ JavaScript Quiz: 78%</li>
                </ul>
            </div>
        </main>
    </div>
    
    <script>
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle('hidden');
        }
    </script>
</body>
</html>


