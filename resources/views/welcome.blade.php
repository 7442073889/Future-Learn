<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    /* Glow Animation */
    @keyframes glow {
        0%, 100% {
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
        }
        50% {
            box-shadow: 0 0 20px rgba(0, 255, 255, 1);
        }
    }

    /* Futuristic Input Glow */
    .futuristic-input:focus {
        border-color: rgba(0, 255, 255, 0.8);
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
        animation: glow 1.5s infinite;
    }

    /* Futuristic Button Hover */
    .futuristic-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px rgba(0, 255, 255, 1);
    }
</style>

</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">

   <!-- Header -->
   <header class="bg-gray-900 bg-opacity-80 fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center p-5">
            <h1 class="text-3xl font-extrabold text-cyan-400">FutureLearn</h1>
            <nav>
                <ul class="flex space-x-8">
                    <li><a href="#features" class="hover:text-cyan-400 transition">Main</a></li>
                    <li><a href="#products" class="hover:text-cyan-400 transition">Products</a></li>
                    <li><a href="#about" class="hover:text-cyan-400 transition">About Us</a></li>
                </ul>
            </nav>
            <div>
                <button id="loginButton" class="px-5 py-2 rounded-md bg-cyan-400 text-gray-900 font-semibold hover:bg-cyan-300 transition">Login</button>
                <button id="registerButton" class="ml-3 px-5 py-2 rounded-md bg-gray-700 border border-cyan-400 hover:bg-gray-800 transition">Register</button>
                <button id="adminLoginButton" class="ml-3 px-5 py-2 rounded-md bg-red-500 text-white font-semibold hover:bg-red-400 transition">Admin Login</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="h-screen flex items-center relative bg-cover bg-center" style="background-image: url('/images/hero-background.jpg');">
        <div class="container mx-auto px-8">
            <div class="text-left max-w-lg">
                <h2 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400 mb-4">
                    Unlock the Future of Learning
                </h2>
                <p class="text-gray-300 text-lg mb-6">
                    Step into the future with courses designed for the digital age. Learn, grow, and achieve.
                </p>
                <a id="getStartedButton" class="px-8 py-3 text-lg font-semibold rounded-full bg-cyan-400 text-gray-900 hover:bg-cyan-300 shadow-lg cursor-pointer">
    Get Started
</a>


            </div>
        </div>
    </section>

    <!-- Admin Login Modal -->
<div id="adminLoginModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50">
    <div class="bg-gradient-to-br from-gray-800 to-gray-700 p-8 rounded-xl shadow-2xl w-96 relative">

    <!-- Success Message -->
    @if (session()->has('success'))
            <div class="alert alert-success text-green-400 text-center mb-4">{{ session('success') }}</div>
        @endif

        <!-- Only One Error Message -->
        @if(session('error'))
            <p class="text-red-500 text-sm text-center mb-4">{{ session('error') }}</p>
        @elseif($errors->any())
            <p class="text-red-500 text-sm text-center mb-4">{{ $errors->first() }}</p>
        @endif

        <h3 class="text-3xl font-extrabold text-red-400 mb-6 text-center">
            <span class="text-purple-400">Admin</span> Login
        </h3>
        
        <form action="{{ route('adminauthenticate') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="adminEmail" class="block text-gray-400 mb-2">Admin Email</label>
                <input type="email" name="email" id="adminEmail" class="w-full bg-gray-900 border border-red-400 p-3 rounded-md text-red-300 focus:outline-none futuristic-input" required>
            </div>
            <div class="mb-5">
                <label for="adminPassword" class="block text-gray-400 mb-2">Password</label>
                <input type="password" name="password" id="adminPassword" class="w-full bg-gray-900 border border-red-400 p-3 rounded-md text-red-300 focus:outline-none futuristic-input" required>
            </div>
            <div class="flex justify-center">
                <button type="button" id="closeAdminLogin" class="px-5 py-2 bg-gray-600 text-white rounded-md mr-2 hover:bg-gray-700 transition-all">Cancel</button>
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-red-400 to-purple-400 text-gray-900 rounded-full font-bold futuristic-button">
                    Admin Login
                </button>
            </div>
        </form>
    </div>
</div>


    <!-- Login Modal -->
<div id="loginModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50">
    <div class="bg-gradient-to-br from-gray-800 to-gray-700 p-8 rounded-xl shadow-2xl w-96 relative">
        
        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="alert alert-success text-green-400 text-center mb-4">{{ session('success') }}</div>
        @endif

        <!-- Only One Error Message -->
        @if(session('error'))
            <p class="text-red-500 text-sm text-center mb-4">{{ session('error') }}</p>
        @elseif($errors->any())
            <p class="text-red-500 text-sm text-center mb-4">{{ $errors->first() }}</p>
        @endif

        <h3 class="text-3xl font-extrabold text-cyan-400 mb-6 text-center">
            <span class="text-purple-400">Login</span> Portal
        </h3>
        
        <form action="{{ route('account.authenticate') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="loginUserId" class="block text-gray-400 mb-2">Email</label>
                <input type="email" name="email" id="loginUserId" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input" required>
            </div>
            <div class="mb-5">
                <label for="loginPassword" class="block text-gray-400 mb-2">Password</label>
                <input type="password" name="password" id="loginPassword" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input" required>
            </div>

            <div class="flex justify-center">
                <button type="button" id="closeLogin" class="px-5 py-2 bg-gray-600 text-white rounded-md mr-2 hover:bg-gray-700 transition-all">Cancel</button>
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-cyan-400 to-purple-400 text-gray-900 rounded-full font-bold futuristic-button">
                    Login
                </button>
            </div>
        </form>
         <!-- Create New Account Link -->
         <div class="text-center mt-4">
            <p class="text-gray-400">Don't have an account? 
                <a href="{{route('account.processRegister')}}" id="openRegisterFromLogin" class="text-cyan-400 hover:underline">Create New Account</a>
            </p>
        </div>
    </div>
</div>
    </div>
</div>


<!-- Register Modal -->
<div id="registerModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-80 flex items-center justify-center z-50">
    <div class="bg-gradient-to-br from-gray-800 to-gray-700 p-8 rounded-xl shadow-2xl w-96 relative">
        <h3 class="text-3xl font-extrabold text-cyan-400 mb-6 text-center">
            <span class="text-purple-400">Register</span> Here
        </h3>
        
        <form action="{{ route('account.processRegister') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="registerName" class="block text-gray-400 mb-2">Name</label>
                <input type="text" name="name" id="registerName" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input @error('name') is-invalid @enderror" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="registerEmail" class="block text-gray-400 mb-2">Email</label>
                <input type="email" name="email" id="registerEmail" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input @error('email') is-invalid @enderror" required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="registerPassword" class="block text-gray-400 mb-2">Password</label>
                <input type="password" name="password" id="registerPassword" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input @error('password') is-invalid @enderror" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block text-gray-400 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-gray-900 border border-cyan-400 p-3 rounded-md text-cyan-300 focus:outline-none futuristic-input" required>
            </div>
            <div class="flex justify-center">
                <button type="button" id="closeRegister" class="px-5 py-2 bg-gray-600 text-white rounded-md mr-2 hover:bg-gray-700 transition-all">Cancel</button>
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-cyan-400 to-purple-400 text-gray-900 rounded-full font-bold futuristic-button">
                    Register
                </button>
            </div>
        </form>

        <!-- Already Have an Account Link -->
        <div class="text-center mt-4">
            <p class="text-gray-400">Already have an account? 
                <a href="#" id="openLoginFromRegister" class="text-cyan-400 hover:underline">Click Here to Login</a>
            </p>
        </div>
    </div>
</div>

<script>
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');

    // Open Login Modal
    document.getElementById('loginButton').addEventListener('click', () => {
        loginModal.classList.remove('hidden');
    });

    // Close Login Modal
    document.getElementById('closeLogin').addEventListener('click', () => {
        loginModal.classList.add('hidden');
    });

    // Open Register Modal
    document.getElementById('registerButton').addEventListener('click', () => {
        registerModal.classList.remove('hidden');
    });

    // Close Register Modal
    document.getElementById('closeRegister').addEventListener('click', () => {
        registerModal.classList.add('hidden');
    });

    // Open Admin Login Modal
    document.getElementById('adminLoginButton').addEventListener('click', () => {
        document.getElementById('adminLoginModal').classList.remove('hidden');
    });

    // Close Admin Login Modal
    document.getElementById('closeAdminLogin').addEventListener('click', () => {
        document.getElementById('adminLoginModal').classList.add('hidden');
    });

    // Switch from Login to Register
    document.getElementById('openRegisterFromLogin').addEventListener('click', (event) => {
        event.preventDefault();
        loginModal.classList.add('hidden');
        registerModal.classList.remove('hidden');
    });

    // Switch from Register to Login
    document.getElementById('openLoginFromRegister').addEventListener('click', (event) => {
        event.preventDefault();
        registerModal.classList.add('hidden');
        loginModal.classList.remove('hidden');
    });
</script>

    
    <!-- Features Section -->
<section id="features" class="py-20">
    <div class="container mx-auto text-center">
        <h3 class="text-4xl font-bold text-cyan-400 mb-12">Why FutureLearn?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Feature Card 1 -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-md transform transition-transform duration-300 hover:scale-105">
                <img src="/images/personalized-profile.png" alt="Personalized Profiles" class="w-16 mx-auto mb-4">
                <h4 class="text-xl font-bold text-purple-400 mb-3">Personalized Profiles</h4>
                <p class="text-gray-400">Craft your own journey with unique profiles and personalized content.</p>
            </div>
            <!-- Feature Card 2 -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-md transform transition-transform duration-300 hover:scale-105">
                <img src="/images/progress-tracking.png" alt="Progress Tracking" class="w-16 mx-auto mb-4">
                <h4 class="text-xl font-bold text-purple-400 mb-3">Progress Tracking</h4>
                <p class="text-gray-400">Never lose track of your progress with detailed analytics.</p>
            </div>
            <!-- Feature Card 3 -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-md transform transition-transform duration-300 hover:scale-105">
                <img src="/images/interactive-quizzes.png" alt="Interactive Quizzes" class="w-16 mx-auto mb-4">
                <h4 class="text-xl font-bold text-purple-400 mb-3">Engaging Quizzes</h4>
                <p class="text-gray-400">Challenge yourself with interactive and fun assessments.</p>
            </div>
        </div>
    </div>
</section>


   <!-- Products Section -->
<section id="products" class="py-20 bg-gray-900">
    <div class="container mx-auto text-center">
        <h3 class="text-4xl font-bold text-cyan-400 mb-12">Our Courses</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <!-- HTML Course Card -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
           
            <img 
                  src="{{ asset('images/html.jpg') }}" alt="HTML Course"
                  class="w-full h-48 object-cover rounded-md mb-4" />

                <h4 class="text-2xl font-bold text-purple-400 mb-2">HTML</h4>
                <p class="text-gray-400 mb-4">
                    Learn the basics of web structure and create beautiful, semantic web pages with HTML.
                </p>
                <button
                    class="bg-cyan-400 text-gray-900 px-4 py-2 rounded-full font-semibold hover:bg-cyan-300"
                    onclick="notifyUser()"
                >
                    Learn More
                </button>
            </div>
            <!-- CSS Course Card -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
            <img 
            src="{{ asset('images/css.jpg') }}" alt="CSS Course"
            class="w-full h-48 object-cover rounded-md mb-4" />

                <h4 class="text-2xl font-bold text-purple-400 mb-2">CSS</h4>
                <p class="text-gray-400 mb-4">
                    Style your web pages with CSS and bring your designs to life with layouts, colors, and animations.
                </p>
                <button
                    class="bg-cyan-400 text-gray-900 px-4 py-2 rounded-full font-semibold hover:bg-cyan-300"
                    onclick="notifyUser()"
                >
                    Learn More
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Update JavaScript -->
<script>
    function notifyUser() {
        Swal.fire({
            icon: 'info',
            title: 'Access Restricted',
            text: 'Please log in or register to access this course.',
            confirmButtonText: 'OK',
        });
    }
</script>





    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-900">
        <div class="container mx-auto text-center">
            <h3 class="text-4xl font-bold text-cyan-400 mb-8">About FutureLearn</h3>
            <div class="flex flex-col md:flex-row items-center md:space-x-10">
                <div class="md:w-1/2">
                    <img src="/images/about-us.jpg" alt="About Us" class="rounded-lg shadow-lg">
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <p class="text-gray-400">
                        FutureLearn is an innovative e-learning platform created by a passionate individual to empower learners with essential knowledge and skills. With a mission to make education engaging and accessible, it combines modern technology and user-friendly design to transform the learning experience for all.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center">
            <p class="text-gray-500">&copy; 2025 FutureLearn. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scroll functionality -->
    <script>
        // Smooth scrolling functionality
        document.getElementById('scrollButton').addEventListener('click', function () {
            const target = document.getElementById('features');
            target.scrollIntoView({ behavior: 'smooth' });
        });
    </script>

<script>
    // Open Register Modal when clicking "Get Started"
    document.getElementById('getStartedButton').addEventListener('click', () => {
        document.getElementById('registerModal').classList.remove('hidden');
    });

    // Close Register Modal when clicking "Cancel"
    document.getElementById('closeRegister').addEventListener('click', () => {
        document.getElementById('registerModal').classList.add('hidden');
    });

</script>

</body>
</html>
