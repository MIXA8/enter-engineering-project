<?php

namespace App\Http\Controllers\Student;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Service\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::with('group')->where('role', UserRoleEnum::STUDENT)->get();
        return Inertia::render('Student/Index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        return Inertia::render('Student/Create', ['role' => UserRoleEnum::TEACHER, 'groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'login' => 'required|string|min:4',
            'group' => 'required|exists:groups,id',
            'last_name' => 'required|string|min:4',
            'patronymic' => 'required|string|min:4',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->login,
            'role' => UserRoleEnum::STUDENT,
            'group_id' => $request->group,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $groups = Group::all();
        $student = User::with('group')->find($request->id);
        return Inertia::render('Student/Edit', ['student' => $student, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'login' => 'required|string|min:4',
            'group' => 'exists:groups,id',
            'last_name' => 'required|string|min:4',
            'patronymic' => 'required|string|min:4',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->role = UserRoleEnum::STUDENT;
        $user->group_id = $request->group;
        $user->patronymic = $request->patronymic;
        $user->last_name = $request->last_name;
        $user->save();
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('student.index');
    }


}
