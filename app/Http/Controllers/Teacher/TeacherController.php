<?php

namespace App\Http\Controllers\Teacher;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where('role', UserRoleEnum::TEACHER)->get();
        return Inertia::render('Teacher/Index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Teacher/Create', ['role' => UserRoleEnum::TEACHER]);
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
            'last_name' => 'required|string|min:4',
            'patronymic' => 'required|string|min:4',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->login,
            'role' => UserRoleEnum::TEACHER,
            'last_name' => $request->last_name,
            'patronymic' => $request->patronymic,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('teacher.index');
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
    public function edit( Request $request)
    {
        $teacher = User::find($request->id);
        return Inertia::render('Teacher/Edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->login = $request->login;
        $user->last_name = $request->last_name;
        $user->patronymic = $request->patronymic;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('teacher.index');
    }
}
