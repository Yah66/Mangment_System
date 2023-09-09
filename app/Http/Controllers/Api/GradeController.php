<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Http\Resources\GradeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $grades = Grade::all();

        return $this->sendResponse(GradeResource::collection($grades), 'all of grades');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name.en' => 'required',
            'name.ar' => 'required',
            'note' => 'nullable',
        ]);

        $grade = new Grade();
        $grade->setTranslation('name', 'en', $request->input('name.en'));
        $grade->setTranslation('name', 'ar', $request->input('name.ar'));
        $grade->note = $request->input('note');
        $grade->save();

        return response()->json([
            'message' => 'Grade Created Successfully',
            'grade' => $grade
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $grade = Grade::findOrFail($id);

        return response()->json([
          
            'grade' => $grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
