<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Service\ReportService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{

    public function listGroup()
    {
        $groups = Group::all();
        return Inertia::render('Report/Index', ['groups' => $groups]);
    }

    public function listStudent(Request $request)
    {
        $students = User::where('group_id', $request->id)->get();
        return Inertia::render('Report/ListStudent', ['students' => $students]);
    }

    public function reportAvg(Request $request)
    {
        return Inertia::render('Report/StudentReport', ['id' => $request->id]);
    }

    public function reportAvgStudent(Request $request, ReportService $service)
    {
        $report = $service->studentReport($request->id);
        return response()->json($report);
    }

    public function reportGroupAvg(Request $request)
    {
        return Inertia::render('Report/GroupReport', ['id' => $request->id]);
    }

    public function reportGroupAvgPrint(Request $request, ReportService $service)
    {
        $report = $service->groupReport($request->id);
        return response()->json($report);
    }
}
