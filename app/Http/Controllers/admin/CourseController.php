<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseContent;
use Illuminate\Support\Facades\Storage; // ✅ Correct Import

class CourseController extends Controller
{
    // ✅ Main HTML Course Screen
    public function learnHtml()
    {
        return view('admin.courses.html');
    }

    // ✅ Retrieve Videos for Admin
    public function htmlVideos()
    {
        $videos = CourseContent::where('type', 'video')->get();
        return view('admin.courses.html-video', compact('videos'));
    }

    // ✅ Store New Video
    public function storeHtmlVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string|max:255' // Store YouTube Video ID
        ]);

        CourseContent::create([
            'type' => 'video',
            'title' => $request->title,
            'content' => $request->video
        ]);

        return response()->json(['success' => true]);
    }

    // ✅ Delete Video
    public function deleteHtmlVideo(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:course_contents,id'
        ]);

        CourseContent::where('id', $request->id)->delete();

        return response()->json(['success' => true]);
    }

    // ✅ Notes Section (Retrieve Notes)
    public function htmlNotes()
    {
        $notes = CourseContent::where('type', 'note')->pluck('content')->toArray();
        return view('admin.courses.html-notes', compact('notes'));
    }

    // ✅ Store Note
    public function storeHtmlNote(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        CourseContent::create([
            'type' => 'note',
            'content' => $request->note
        ]);

        return response()->json(['success' => true]);
    }

    // ✅ Delete Note
    public function deleteHtmlNote(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:course_contents,id'
        ]);

        CourseContent::where('id', $request->id)->delete();

        return response()->json(['success' => true]);
    }

    // ✅ Theory Section (Retrieve Theory Points)
    public function htmlTheory()
    {
        $theory = CourseContent::where('type', 'theory')->get();
        return view('admin.courses.html-theory', compact('theory'));
    }

    // ✅ Store Theory (With PDF Upload)
    public function storeHtmlTheory(Request $request)
    {
        $request->validate([
            'theory' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Handle PDF Upload
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('theory_pdfs', 'public'); // Save in storage/app/public/theory_pdfs
        }

        CourseContent::create([
            'type' => 'theory',
            'title' => $request->theory,
            'content' => $pdfPath // Store PDF path
        ]);

        return response()->json(['success' => true]);
    }

    // ✅ Delete Theory (With PDF File Deletion)
    public function deleteHtmlTheory(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:course_contents,id'
        ]);

        $theory = CourseContent::find($request->id);

        // ✅ Check if the theory exists and has a PDF
        if ($theory && !empty($theory->content)) {
            Storage::delete('public/' . $theory->content); // ✅ Correct Storage usage
        }

        $theory->delete();

        return response()->json(['success' => true]);
    }
}
