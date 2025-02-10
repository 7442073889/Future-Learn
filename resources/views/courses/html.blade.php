<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn HTML - Future Learn</title>
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
        <h1 class="text-xl font-bold neon-text">🚀 Learn HTML</h1>
        <a href="{{ route('account.dashboard') }}" class="bg-blue-500 neon-button text-white px-4 py-2 rounded">⬅ Back to Dashboard</a>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6">
        <div class="glass p-6 rounded-lg">
            <h2 class="text-2xl font-bold neon-text">Introduction to HTML</h2>
            <p class="text-gray-300 mt-2">
                HTML (HyperText Markup Language) is the standard markup language for creating web pages.
            </p>
        </div>

        <!-- Lesson Outline -->
        <div class="glass p-6 rounded-lg mt-6">
            <h3 class="text-xl font-semibold neon-text">Lesson Outline</h3>
            <ul class="mt-3 space-y-2 text-gray-300">
                <li>📌 Basics of HTML</li>
                <li>📌 Tags & Elements</li>
                <li>📌 Forms & Inputs</li>
                <li>📌 Tables & Lists</li>
            </ul>
        </div>

        <!-- Code Example -->
        <div class="glass p-6 rounded-lg mt-6">
            <h3 class="text-xl font-semibold neon-text">HTML Example</h3>
            <p class="text-gray-300">This is a simple HTML structure:</p>
            <pre class="bg-gray-800 text-white p-4 rounded-lg mt-2">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;My First Page&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Hello, World!&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;
            </pre>
        </div>
    </div>

</body>
</html>
