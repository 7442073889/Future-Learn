<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Theory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <!-- Back Button -->
    <div class="flex justify-end mb-6">
    <a href="{{ route('admin.course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900 transition duration-300">
        ⬅ Back to Dashboard
    </a>
</div>


    <h1 class="text-4xl font-extrabold text-center mb-8 text-white">📚 HTML Theory</h1>

    <!-- Success/Error Message -->
    <div id="message-box" class="hidden p-4 mb-4 text-center rounded-lg text-white"></div>

    <!-- Theory List -->
    <div class="space-y-4">
    @foreach ($theory as $point)
    <div class="bg-gray-800 p-4 rounded-lg shadow-lg flex justify-between items-center hover:shadow-2xl transition duration-300">
        <span class="text-lg font-medium text-gray-300">{{ $point->title }}</span>
        
        <div class="flex space-x-4">
            @if (!empty($point->content))
                <a href="{{ asset('storage/' . $point->content) }}" target="_blank" 
                   class="text-blue-400 hover:text-blue-600 transition duration-300 flex items-center space-x-1">
                    📄 <span>View PDF</span>
                </a>
            @endif
            <button onclick="deleteTheory({{ $point->id }})" 
                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">
                ❌ Delete
            </button>
        </div>
    </div>
@endforeach

    </div>

    <!-- Add Theory Form -->
    <div class="mt-10 p-6 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-white mb-4">➕ Add New Theory</h2>
        
        <form id="add-theory-form" enctype="multipart/form-data">
            @csrf
            <input type="text" id="theory-input" name="theory" 
                   class="w-full p-3 mb-3 bg-gray-700 text-white rounded-lg shadow-inner"
                   placeholder="Enter new theory point..." required>
            
            <input type="file" id="pdf-file" name="pdf" accept="application/pdf" 
                   class="w-full p-3 mb-3 bg-gray-700 text-white rounded-lg shadow-inner">

            <button type="submit" 
                    class="w-full bg-blue-500 px-4 py-3 text-white rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                📤 Add Theory
            </button>
        </form>
    </div>

    <script>
    // Function to display messages
    function showMessage(message, type = "success") {
        let messageBox = document.getElementById("message-box");
        messageBox.textContent = message;
        messageBox.classList.remove("hidden", "bg-red-500", "bg-green-500");

        if (type === "error") {
            messageBox.classList.add("bg-red-500");
        } else {
            messageBox.classList.add("bg-green-500");
        }

        setTimeout(() => {
            messageBox.classList.add("hidden");
        }, 3000);
    }

    // Handle Theory Submission
    document.getElementById("add-theory-form").onsubmit = async function(event) {
        event.preventDefault();

        const theoryInput = document.getElementById("theory-input");
        const pdfFile = document.getElementById("pdf-file").files[0];

        if (theoryInput.value.trim() === "") {
            showMessage("❌ Theory text cannot be empty!", "error");
            return;
        }

        const formData = new FormData();
        formData.append("theory", theoryInput.value.trim());
        if (pdfFile) {
            formData.append("pdf", pdfFile);
        }

        try {
            let response = await fetch("{{ route('admin.course.html.theory.store') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData
            });

            let result = await response.json();
            if (result.success) {
                theoryInput.value = "";
                document.getElementById("pdf-file").value = "";
                showMessage("✅ Theory added successfully!");
                setTimeout(() => location.reload(), 1000);
            } else {
                showMessage("❌ Error adding theory.", "error");
            }
        } catch (error) {
            console.error("Error:", error);
            showMessage("❌ Server error. Try again!", "error");
        }
    };

    // Handle Deleting Theory
    async function deleteTheory(id) {
    if (!confirm("Are you sure you want to delete this theory and its PDF?")) return;

    try {
        let response = await fetch("{{ route('admin.course.html.theory.delete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id }) // ✅ Use database ID
        });

        let result = await response.json();
        if (result.success) {
            alert("✅ Theory deleted successfully!");
            location.reload();
        } else {
            alert("❌ Error deleting theory.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("❌ Server error. Try again!");
    }
}

    </script>

</body>
</html>


