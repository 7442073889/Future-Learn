<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Quiz - Future Learn</title>
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
    </style>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">

    <!-- Navigation Bar -->
    <nav class="glass flex justify-between items-center p-4 mx-4 my-4">
        <h1 class="text-xl font-bold neon-text">🎨 CSS Quiz</h1>
        <a href="{{ route('account.dashboard') }}" class="bg-blue-500 neon-button text-white px-4 py-2 rounded">⬅ Back to Dashboard</a>
    </nav>

    <!-- Quiz Section -->
    <div class="container mx-auto p-6">
        <div class="glass p-6 rounded-lg">
            <h2 class="text-2xl font-bold neon-text">Test Your CSS Knowledge</h2>
            <p class="text-gray-300 mt-2">
                Answer the following questions and test your CSS skills.
            </p>
        </div>

        <!-- Quiz Questions -->
        <div class="glass p-6 rounded-lg mt-6">
        <form action="{{ route('quiz.css.submit') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-300">1. What does CSS stand for?</label>
        <input type="text" name="q1" class="w-full p-2 mt-2 bg-gray-800 text-white border border-gray-600 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-gray-300">2. How do you apply a background color in CSS?</label>
        <input type="text" name="q2" class="w-full p-2 mt-2 bg-gray-800 text-white border border-gray-600 rounded">
    </div>

    <button type="submit" class="bg-green-500 neon-button text-white px-4 py-2 rounded">Submit Quiz</button>
</form>

        </div>
    </div>

</body>
</html>
