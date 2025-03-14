<?php
namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Traks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Get the currently logged-in user's ID
    
        if (!$userId) {
            // If no user is logged in, return an empty view or redirect to login
            return redirect()->route('login');
        }
    
        // Get the IDs of the courses the user has purchased and ensure it's a collection
        $purchasedCourseIds = collect(
            DB::table('course_user')
                ->where('user_id', $userId) // Filter by the logged-in user's ID
                ->pluck('course_id') // Retrieve only the course IDs
                ->toArray()
        );
    
        // Get all courses
        $courses = Courses::all();
    
        // Pass both courses and purchasedCourseIds to the view
        return view('courses.index', compact('courses', 'purchasedCourseIds'));
    }
    
    

    public function getCoursesByTrak($trakId)
    {
        
        $courses = Courses::where('track_id', $trakId)->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $traks = Traks::all();
        return view('courses.create', compact('traks'));
    }
    public function store(Request $request)
    {
        $user = auth()->user(); // Get the current user
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseDescription' => 'nullable|string',
            'intro_video' => 'required|file|mimes:mp4,mov,avi|max:2048000', // File size in KB (2000 MB = 2048000 KB)
            'track_id' => 'required|exists:traks,id',
            'coursePhoto' => 'required|image|max:51200',
            'Price' => 'required|numeric|min:0',
            'bayState' => 'required|boolean',
        ]);
    
        // Store the video and get the file path
        $videoPath = $request->file('intro_video')->store('courseVideos', 'public');
    
        $coursePhotoPath = $request->file('coursePhoto')->storeAs(
            'courses', 
            uniqid() . '.' . $request->file('coursePhoto')->getClientOriginalExtension(),
            'public'
        );
    
        $validated['coursePhoto'] = $coursePhotoPath;
    
        Courses::create([
            'courseName' => $validated['courseName'],
            'courseDescription' => $validated['courseDescription'],
            'intro_video' => $videoPath,
            'user_id' => $user->id,
            'track_id' => $validated['track_id'],
            'coursePhoto' => $validated['coursePhoto'],
            'Price' => $validated['Price'],
            'bayState' => $validated['bayState'],
        ]);
    
        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }
    public function show(Courses $course)
    {
        $users = User::all(); // Retrieve all users
        return view('courses.show', compact('course','users'));
    }

    public function edit(Courses $course)
    {
        $traks = Traks::all();
        return view('courses.edit', compact('course', 'traks'));
    }

    public function update(Request $request, Courses $course)
    {
        // Validate the request, making sure we only handle fields relevant for update
        $validated = $request->validate([
            'courseName' => 'sometimes|string|max:255',
            'courseDescription' => 'sometimes|string',
            'track_id' => 'sometimes|exists:traks,id',
            'coursePhoto' => 'sometimes|image|max:51200', // Validate new course image
            'Price' => 'sometimes|numeric|min:0',
            'bayState' => 'sometimes|boolean',
        ]);

        // If a new course image is uploaded
        if ($request->hasFile('coursePhoto')) {
            // Delete the old course image from storage
            $oldImagePath = $course->coursePhoto;  // Use coursePhoto instead of course_image

            // Log the path for debugging
            Log::info('Attempting to delete old course image at: ' . $oldImagePath);

            // Check if the old image exists in storage
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath); // Delete the old image
                Log::info('Old course image deleted successfully: ' . $oldImagePath);
            } else {
                Log::warning('Old course image not found: ' . $oldImagePath);
            }

            // Store the new course image and get the path
            $coursePhotoPath = $request->file('coursePhoto')->storeAs(
                'courses', 
                uniqid() . '.' . $request->file('coursePhoto')->getClientOriginalExtension(),
                'public'
            );
            $validated['coursePhoto'] = $coursePhotoPath; // Update course photo path
        }

        // Update the course with new details
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Courses $course)
    {
        // Get the path of the course image (coursePhoto)
        $imagePath = $course->coursePhoto;

        // Log the path for debugging
        Log::info('Attempting to delete course image at: ' . $imagePath);

        // Check if the image exists in storage
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath); // Delete the image
            Log::info('Course image deleted successfully: ' . $imagePath);
        } else {
            Log::warning('Course image not found: ' . $imagePath);
        }

        // Delete the course record from the database
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
