<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.course.html') }}" class="bg-gray-700 px-4 py-2 text-white rounded-lg hover:bg-gray-900 transition duration-300">
        ⬅ Back to Dashboard
    </a>
</div>

    <h1 class="text-3xl font-bold mb-6 text-center">HTML Notes & Shortcuts</h1>

    <!-- Add New Note Form -->
    <div class="mb-6 p-4 bg-gray-800 rounded-lg">
        <h2 class="text-xl font-bold mb-2 text-white">➕ Add New Note</h2>
        <form id="add-note-form">
            <input type="text" id="note-text" placeholder="Enter note..." class="w-full p-2 mb-2 bg-gray-700 text-white rounded">
            <button type="submit" class="bg-green-500 px-4 py-2 text-white rounded w-full hover:bg-green-700">
                Add Note
            </button>
        </form>
    </div>

    <!-- Notes List -->
    <ul id="notes-list" class="list-disc pl-8">
        @foreach ($notes as $index => $note)
            <li class="mb-2 text-lg flex justify-between items-center">
                <span>{{ $note }}</span>
                <button onclick="deleteNote({{ $index }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                    ❌ Delete
                </button>
            </li>
        @endforeach
    </ul>

    <script>
        document.getElementById("add-note-form").onsubmit = async function(event) {
            event.preventDefault();
            
            const noteText = document.getElementById("note-text").value;
            
            if (noteText) {
                try {
                    let response = await fetch("{{ route('admin.course.html.notes.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            note: noteText
                        })
                    });

                    let result = await response.json();
                    if (result.success) {
                        location.reload(); // Reload to show the new note
                    } else {
                        alert("Error adding note.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            }
        };

        async function deleteNote(index) {
            if (!confirm("Are you sure you want to delete this note?")) return;

            try {
                let response = await fetch("{{ route('admin.course.html.notes.delete') }}", {
                method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        index: index
                    })
                });

                let result = await response.json();
                if (result.success) {
                    location.reload(); // Reload to update the list
                } else {
                    alert("Error deleting note.");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }
    </script>

</body>
</html>



