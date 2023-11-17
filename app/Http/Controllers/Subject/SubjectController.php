<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::with('group')->get();
        return Inertia::render('Subject/Index', ['subjects' => $subject]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        return Inertia::render('Subject/Create', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'required|exists:groups,id'
        ]);
        $subject = Subject::create([
            'name' => $request->name,
            'group_id' => $request->group,
        ]);
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $groups = Group::all();
        $subject = Subject::with('group')->find($request->id);
        return Inertia::render('Subject/Edit', ['subject' => $subject, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'group' => 'required|exists:groups,id'
        ]);
        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->group_id = $request->group;
        $subject->save();
        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Subject::find($request->id);
        $user->delete();
        return redirect()->route('subject.index');
    }

    public function indexForStudent(Request $request)
    {
        $subject = Subject::with('group')->where('group_id',$request->group_id)->get();
        return Inertia::render('Subject/Index', ['subjects' => $subject]);
    }
}
