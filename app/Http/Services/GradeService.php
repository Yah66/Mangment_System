<?php

namespace app\Services;

use App\Grade;
use App\Http\Requests\GradeRequest;

class GradeService
{
    public function getGrades()
    {
        $Grades  = Grade::all();
        return $Grades;
    }

    public function getGrade($id)
    {
        return Grade::findOrFail($id);
    }

    public function create($data)
    {
        return Grade::create($data);
    }


    public function update($id, $data)
    {
        $grade = $this->getGrade($id);
        return $grade->update($data);
    }

    public function deleteGrade($id, $data)
    {
        $grade = $this->getGrade($id);
        return $grade->delete();
    }

}
