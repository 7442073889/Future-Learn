<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Live Coding Practice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/css/css.min.js"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <!-- Navigation Bar -->
    <nav class="mb-6 flex justify-between items-center bg-gray-800 p-4 rounded-lg">
        <h1 class="text-2xl font-bold">Live Practice</h1>
        <a href="{{ route('account.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            ⬅ Back to Dashboard
        </a>
    </nav>

    <!-- Template Selector -->
    <div class="mb-4">
        <label for="template" class="block text-lg mb-2">Choose a Template:</label>
        <select id="template" class="p-2 bg-gray-800 text-white rounded">
            <option value="">Select a template</option>
        </select>
        <button onclick="loadTemplate()" class="ml-2 p-2 bg-purple-600 rounded">Load</button>
    </div>

    <!-- Editor Section -->
    <div class="grid grid-cols-2 gap-4">
        <!-- HTML Editor -->
        <div>
            <h2 class="text-xl mb-2">HTML Code</h2>
            <textarea id="html-code" class="w-full h-40 p-2 bg-gray-800 text-white"></textarea>
        </div>

        <!-- CSS Editor -->
        <div>
            <h2 class="text-xl mb-2">CSS Code</h2>
            <textarea id="css-code" class="w-full h-40 p-2 bg-gray-800 text-white"></textarea>
        </div>
    </div>

    <!-- Output Section -->
    <h2 class="text-xl mt-4">Live Output</h2>
    <iframe id="output" class="w-full h-64 bg-white mt-2"></iframe>

    <script>
        // Load templates from local storage (set by admin)
        let templates = JSON.parse(localStorage.getItem("templates")) || {};

        function loadTemplateOptions() {
            let templateSelector = document.getElementById("template");
            templateSelector.innerHTML = '<option value="">Select a template</option>';

            Object.keys(templates).forEach(templateName => {
                let option = document.createElement("option");
                option.value = templateName;
                option.textContent = templateName;
                templateSelector.appendChild(option);
            });
        }

        function loadTemplate() {
            let selectedTemplate = document.getElementById("template").value;
            if (templates[selectedTemplate]) {
                htmlEditor.setValue(templates[selectedTemplate].html);
                cssEditor.setValue(templates[selectedTemplate].css);
                updateOutput();
            }
        }

        function updateOutput() {
            let htmlCode = htmlEditor.getValue();
            let cssCode = cssEditor.getValue();
            let outputFrame = document.getElementById("output").contentWindow.document;

            outputFrame.open();
            outputFrame.write(`<style>${cssCode}</style> ${htmlCode}`);
            outputFrame.close();
        }

        // Initialize CodeMirror for better editing experience
        let htmlEditor = CodeMirror.fromTextArea(document.getElementById("html-code"), {
            mode: "htmlmixed",
            theme: "dracula",
            lineNumbers: true
        });

        let cssEditor = CodeMirror.fromTextArea(document.getElementById("css-code"), {
            mode: "css",
            theme: "dracula",
            lineNumbers: true
        });

        htmlEditor.on("change", updateOutput);
        cssEditor.on("change", updateOutput);

        // Load templates when the page loads
        loadTemplateOptions();
    </script>

</body>
</html>

