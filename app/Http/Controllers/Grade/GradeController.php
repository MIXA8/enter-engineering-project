<?php

namespace App\Http\Controllers\Grade;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use App\Service\ReportService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('group')->get();
        return Inertia::render('Grade/Index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $students = User::where('group_id', '=', $request->group_id)->where('role', '=', UserRoleEnum::STUDENT)->get();
        $subject = Subject::with('group')->find($request->subject_id);
        return Inertia::render('Grade/Create', ['students' => $students, 'subject' => $subject]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'student' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|string|min:0|max:5',
        ]);
        $grade = Grade::create(
            [
                'user_id' => $request->student,
                'subject_id' => $request->subject_id,
                'grade' => $request->grade,
            ]
        );

        return redirect()->route(
            'grade.show.list',
            ['subject_id' => $request->subject_id, 'group_id' => $request->group_id]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $grade = Grade::with('user', 'subject')->find($request->grade_id);
        return Inertia::render('Grade/Edit', ['grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'grade' => 'required|min:0|max:5',
            'subject_id' => 'required',
            'group_id' => 'required',
        ]);
        $grade = Grade::find($request->grade_id);
        $grade->grade = $request->grade;
        $grade->save();

        return redirect()->route(
            'grade.show.list',
            ['subject_id' => $request->subject_id, 'group_id' => $request->group_id]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $grade = Grade::find($request->grade_id);
        $subject_id = $grade->subject_id;
        $grade->delete();

        return redirect()->route(
            'grade.show.list',
            ['subject_id' => $subject_id, 'group_id' => $request->group_id]
        );
    }

    public function gradeList(Request $request, ReportService $service)
    {
        $allGrades = $service->avgGradeList($request->group_id, $request->subject_id);
        $results = $service->avgGradeListHelp($allGrades);

        $name_group = Group::find($request->group_id);
        $name_subject = Subject::find($request->subject_id);
        return Inertia::render(
            'Grade/List',
            [
                'results' => $allGrades,
                'group_id' => $request->group_id,
                'subject_id' => $request->subject_id,
                'name_group' => $name_group,
                'name_subject' => $name_subject,
                'avg' => $results,
            ]
        );
    }

}
