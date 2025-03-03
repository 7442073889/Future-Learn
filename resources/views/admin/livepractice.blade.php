<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Coding Practice</title>
    
    <!-- Tailwind & CodeMirror -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/css/css.min.js"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <!-- Navigation Bar -->
    <nav class="mb-6 flex justify-between items-center bg-gray-800 p-4 rounded-lg">
        <h1 class="text-2xl font-bold">Live HTML & CSS Practice</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            ⬅ Back to Dashboard
        </a>
    </nav>

    <!-- Template Selector -->
    <div class="mb-4">
        <label for="template" class="block text-lg mb-2">Choose a Template:</label>
        <select id="template" class="p-2 bg-gray-800 text-white rounded w-full">
            <option value="">Select a template</option>
        </select>
        <div class="mt-2 flex gap-2">
            <button onclick="loadTemplate()" class="p-2 bg-purple-600 rounded w-1/2">Load</button>
            <button onclick="deleteTemplate()" class="p-2 bg-red-600 rounded w-1/2">Delete</button>
        </div>
    </div>

    <!-- Add New Template -->
    <div class="mb-4 bg-gray-800 p-4 rounded-lg">
        <h2 class="text-lg mb-2">➕ Add New Template</h2>
        <input type="text" id="new-template-name" placeholder="Enter template name" class="p-2 bg-gray-700 text-white rounded w-full mb-2">
        
        <h3 class="mt-2">HTML Code</h3>
        <textarea id="new-html-code" class="w-full h-20 p-2 bg-gray-700 text-white"></textarea>

        <h3 class="mt-2">CSS Code</h3>
        <textarea id="new-css-code" class="w-full h-20 p-2 bg-gray-700 text-white"></textarea>

        <button onclick="saveTemplate()" class="mt-2 p-2 bg-green-600 rounded w-full">Save Template</button>
    </div>

    <!-- Editor Section -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h2 class="text-xl mb-2">HTML Code</h2>
            <textarea id="html-code" class="w-full h-40 p-2 bg-gray-800 text-white"></textarea>
        </div>

        <div>
            <h2 class="text-xl mb-2">CSS Code</h2>
            <textarea id="css-code" class="w-full h-40 p-2 bg-gray-800 text-white"></textarea>
        </div>
    </div>

    <!-- Output Section -->
    <h2 class="text-xl mt-4">Live Output</h2>
    <iframe id="output" class="w-full h-64 bg-white mt-2"></iframe>

    <script>
        // Load stored templates from Local Storage
        let templates = JSON.parse(localStorage.getItem("templates")) || {
            basic: {
                html: "<h1>Welcome to Live Practice</h1><p>Edit this template and see changes!</p>",
                css: "body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; text-align: center; }"
            }
        };

        function loadTemplateOptions() {
            let templateSelect = document.getElementById("template");
            templateSelect.innerHTML = '<option value="">Select a template</option>';
            for (let key in templates) {
                let option = document.createElement("option");
                option.value = key;
                option.textContent = key;
                templateSelect.appendChild(option);
            }
        }

        function loadTemplate() {
            let selectedTemplate = document.getElementById("template").value;
            if (templates[selectedTemplate]) {
                htmlEditor.setValue(templates[selectedTemplate].html);
                cssEditor.setValue(templates[selectedTemplate].css);
                updateOutput();
            }
        }

        function saveTemplate() {
            let templateName = document.getElementById("new-template-name").value.trim();
            let htmlContent = document.getElementById("new-html-code").value.trim();
            let cssContent = document.getElementById("new-css-code").value.trim();

        if (templateName === "") {
            alert("Please enter a template name.");
            return;
    }

          templates[templateName] = { html: htmlContent, css: cssContent };
          localStorage.setItem("templates", JSON.stringify(templates));
          loadTemplateOptions();
         alert(`Template "${templateName}" saved successfully!`);
    }


        function deleteTemplate() {
            let selectedTemplate = document.getElementById("template").value;
            if (!selectedTemplate || !templates[selectedTemplate]) {
                alert("Please select a template to delete.");
                return;
            }

            if (confirm(`Are you sure you want to delete "${selectedTemplate}"?`)) {
                delete templates[selectedTemplate];
                localStorage.setItem("templates", JSON.stringify(templates));
                loadTemplateOptions();
                alert("Template deleted successfully!");
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

        // Initialize CodeMirror for editing experience
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

        // Load template options on page load
        loadTemplateOptions();
    </script>

</body>
</html>




