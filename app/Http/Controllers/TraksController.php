<?php
namespace App\Http\Controllers;

use App\Models\Traks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TraksController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $traks = Traks::when($search, function ($query, $search) {
            $query->where('trackName', 'LIKE', '%' . $search . '%');
        })->get();

        return view('traks.index', compact('traks'));
    }

    public function create()
    {
        // Show the form for creating a new track
        return view('traks.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'trackName' => 'required|string|max:255',
            'trackPhoto' => 'required|image|max:2048',
            'trackDescription' => 'required|string',
            'trackCategory' => 'required|string|max:255',
        ]);

        // Check if a track photo is uploaded and store it
        if ($request->hasFile('trackPhoto')) {
            $trackPhotoPath = $request->file('trackPhoto')->store('tracks', 'public');
        } else {
            return redirect()->back()->with('error', 'Please upload a valid image.');
        }

        // Create a new track record in the database
        Traks::create([
            'trackName' => $validated['trackName'],
            'trackPhoto' => $trackPhotoPath,
            'trackDescription' => $validated['trackDescription'],
            'trackCategory' => $validated['trackCategory'],
        ]);

        return redirect()->route('traks.index')->with('success', 'Track added successfully!');
    }

    public function show(Traks $trak)
    {
        // Display the details of a specific track
        return view('traks.show', compact('trak'));
    }

    public function edit(Traks $trak)
    {
        // Show the form to edit a specific track
        return view('traks.edit', compact('trak'));
    }

    public function update(Request $request, Traks $trak)
    {
        // Validate the input data
        $validated = $request->validate([
            'trackName' => 'required|string|max:255',
            'trackDescription' => 'nullable|string',
            'trackPhoto' => 'nullable|image|max:2048',
        ]);

        // Check if a new track photo is uploaded
        if ($request->hasFile('trackPhoto')) {
            // Delete the old track photo if it exists
            $oldImagePath = $trak->trackPhoto;
            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
                Log::info('Old track image deleted: ' . $oldImagePath);
            }

            // Store the new track photo
            $trackPhotoPath = $request->file('trackPhoto')->store('tracks', 'public');
            $validated['trackPhoto'] = $trackPhotoPath;
        } else {
            // Retain the current track photo if no new photo is uploaded
            $validated['trackPhoto'] = $trak->trackPhoto;
        }

        // Update the track details in the database
        $trak->update([
            'trackName' => $validated['trackName'],
            'trackDescription' => $validated['trackDescription'],
            'trackPhoto' => $validated['trackPhoto'],
        ]);

        return redirect()->route('traks.index')->with('success', 'Track updated successfully.');
    }

    public function destroy(Traks $trak)
    {
        // Get the path of the track photo
        $imagePath = $trak->trackPhoto;

        // Delete the track photo if it exists in storage
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            Log::info('Track photo deleted: ' . $imagePath);
        } else {
            Log::warning('Track photo not found: ' . $imagePath);
        }

        // Delete the track record from the database
        $trak->delete();

        return redirect()->route('traks.index')->with('success', 'Track deleted successfully.');
    }
}
