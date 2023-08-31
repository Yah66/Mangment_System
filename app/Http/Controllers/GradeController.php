<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\GradeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GradeService;

class GradeController extends Controller
{
    protected $gradeService;

    public function __construct(GradeService $gradeService)
    {
        $this->gradeService = $gradeService;
    }

    public function index()
    {
        $grades = $this->gradeService->getGrades();
        return view('pages.grades.grade', compact('grades'));
        // $Grades  = Grade::all();
        // return view('pages.grades.grade', ['Grades' => $Grades]);
    }

    public function store(GradeRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();
            // dd($validated['name_en']);
            // Handle the image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('grades');
            }


            $grade = new Grade();

            // Set the translatable name for 'en' and 'ar'
            $grade->setTranslation('name', 'en', $validated['name_en']);
            $grade->setTranslation('name', 'ar', $validated['name']);

            // Set other non-translatable attributes
            $grade->note = $validated['note'];
            $grade->image = $imagePath; // Assuming you have an 'image_path' column in your database table

            // Save the Grade instance
            $grade->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(GradeRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Find the Grade model
            $grade = Grade::findOrFail($request->id);

            // Handle the image upload
            $imagePath = $grade->image; // Preserve the existing image path
            if ($request->hasFile('image')) {
                // Delete the existing image
                if ($imagePath) {
                    Storage::delete($imagePath);
                }
                // Store the new image
                $imagePath = $request->file('image')->store('grades');
            }

            // Update the translatable name
            $grade->setTranslation('name', 'en', $validated['name_en']);
            $grade->setTranslation('name', 'ar', $validated['name']);

            // Update other non-translatable attributes
            $grade->note = $validated['note'];
            $grade->image = $imagePath; // Update the image path

            $grade->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $grade = Grade::findOrFail($id);

            // Delete the image file if it exists
            if ($grade->image) {
                Storage::delete($grade->image);
            }

            $grade->delete();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
