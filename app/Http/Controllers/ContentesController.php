<?php

namespace App\Http\Controllers;

use App\Models\Contentes;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContentesController extends Controller
{
    // Display all contents
    public function index()
    {
        $contents = Contentes::all();
        return view('contents.index', compact('contents'));
    }
    
// Display contents related to a specific course
public function getContentsByCourse($courseId)
{
    $userId = auth()->id(); // Get the current user's ID
    $user = auth()->user();

    // Get the course details to check its price
    $course = Courses::find($courseId);

    // Check if the user has purchased the course or if the course is free (price < 1)
    $hasPurchased = DB::table('course_user')
        ->where('user_id', $userId) // Match the user's ID
        ->where('course_id', $courseId) // Match the course's ID
        ->exists(); // Check if such a record exists

    // Allow access if the user is an admin
    if ($user->role == 'admin') {
        $hasPurchased = true;
    }

    // Check if the user has access to the course content
    if (!$hasPurchased && $course->Price > 1) {
        // If the user has not purchased the course and the course is not free, show an error message
        return redirect()->route('courses.index')->with('error', 'You do not have access to this course content.');
    }

    // If the user has purchased the course or the course is free, fetch the associated content
    $contents = Contentes::where('course_id', $courseId)->get();
    
    // Return the view with the content
    return view('contents.show', compact('contents'));
}

    

    // Show form to create a new content
    public function create()
    {
        $courses = Courses::all(); // Fetch all courses to choose from
        return view('contents.create', compact('courses'));
    }

    // Store a new content
    public function store(Request $request)
    {
        $validated = $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi|max:2048000', // File size in KB (2000 MB = 2048000 KB)
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);
    
        // Store the video and get the file path
        $videoPath = $request->file('video')->store('videos', 'public');
    
        // Create the new content
        Contentes::create([
            'url' => $videoPath,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'course_id' => $validated['course_id'],
        ]);
    
        return redirect()->route('contents.index')->with('success', 'Content added successfully.');
    }

    // Show a specific content details
    public function show($id)
{
    $content = Contentes::find($id);

    if (!$content) {
        abort(404, 'Content not found');
    }

    // Debugging output
    dd($content);

    // Fetch additional data
    $shorts = Contentes::where('type', 'short')->latest()->take(6)->get();
    $relatedContents = Contentes::where('course_id', $content->course_id)
        ->where('id', '!=', $content->id)
        ->limit(5)
        ->get();

    return view('contents.show', compact('content', 'shorts', 'relatedContents'));
}

    // Show form to edit a specific content
    public function edit(Contentes $content)
    {
        $courses = Courses::all(); // Fetch all courses to choose from
        return view('contents.edit', compact('content', 'courses'));
    }


    public function update(Request $request, Contentes $content)
{
    $validated = $request->validate([
        'title' => 'sometimes|string|max:255',
        'course_id' => 'sometimes|exists:courses,id',
        'video' => 'sometimes|file|mimes:mp4,mov,avi|max:51200', // Validate new video file
    ]);
    
    // If a new video is uploaded
    if ($request->hasFile('video')) {
        // Get the path of the old video
        $oldvideoPath = $content->url;  // $content->url contains the full path, so no need to add 'videos/'

        // Log the path for debugging
        Log::info('Attempting to delete old video at: ' . $oldvideoPath);

        // Check if the old video file exists in the storage
        if (Storage::disk('public')->exists($oldvideoPath)) {
            Storage::disk('public')->delete($oldvideoPath); // Delete the old video from storage
            Log::info('Old video deleted successfully: ' . $oldvideoPath);
        } else {
            Log::warning('Old video not found: ' . $oldvideoPath);
        }

        // Store the new video and get the file path
        $videoPath = $request->file('video')->store('videos', 'public');
        $validated['url'] = $videoPath; // Update video path in the validation array
    }
    
    // Update content with new details
    $content->update($validated);
    
    return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
}


    
    public function destroy(Contentes $content)
{
    // Get the path of the video (ensure to remove any repetition of 'videos')
    $videoPath = $content->url;  // $content->url contains the full path, so no need to add 'videos/'

    // Log the path for debugging
    Log::info('Attempting to delete video at: ' . $videoPath);

    // Check if the video file exists in the storage
    if (Storage::disk('public')->exists($videoPath)) {
        Storage::disk('public')->delete($videoPath); // Delete the video from storage
        Log::info('Video deleted successfully: ' . $videoPath);
    } else {
        Log::warning('Video not found: ' . $videoPath);
    }

    // Delete the content record from the database
    $content->delete();

    return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
}

}
