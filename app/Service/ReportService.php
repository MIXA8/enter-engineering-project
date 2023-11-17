<?php

namespace App\Service;

use App\Enums\UserRoleEnum;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportService
{

    public function studentReport(int $id)
    {
        $user = User::with(['group', 'grades'])->where(
            [
                ['role', '=', UserRoleEnum::STUDENT],
                ['id', '=', $id],
            ]
        )->first();
        $grades = DB::table('grades')
            ->select(
                'users.name as users_name',
                'users.last_name as users_last',
                'users.patronymic as users_patronymic',
                'groups.name as group',
                'subjects.name as subject',
                DB::raw('AVG(grades.grade) as average_grade')
            )
            ->join('users', 'grades.user_id', '=', 'users.id')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('users.id', $id)
            ->groupBy('users.name', 'users.last_name', 'users.patronymic', 'groups.name', 'subjects.name')
            ->get();
        return $grades;
    }

    public function groupReport(int $id)
    {
        $grades = Grade::join('users', 'grades.user_id', '=', 'users.id')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->select(
                'groups.name as group',
                'subjects.name as subject',
                DB::raw('AVG(grades.grade) as average_grade')
            )
            ->where('groups.id', $id)
            ->groupBy('groups.name', 'subjects.name')
            ->orderByDesc('groups.name')
            ->get();
        return $grades;
    }

    public function avgGradeList(int $group_id, int $subject_id)
    {
        $results = Grade::with('user')->join('users', 'grades.user_id', '=', 'users.id')
            ->where('users.group_id', $group_id)
            ->where('grades.subject_id', $subject_id)
            ->select(
                'users.name as user_name',
                'users.id as user_id',
                'users.last_name as user_last_name',
                'users.patronymic as users_patronymic',
                'users.group_id as users_group_id',
                'grade',
                'grades.grade as grades_grade',
                'grades.id as grades_id',
            )
            ->get();
        return $results;
    }

    public function avgGradeListHelp($results)
    {
        $count = count($results);
        $totalGrades = 0;
        foreach ($results as $result) {
            $totalGrades += $result->grade;
        }
        if ($count > 0) {
            $result = $totalGrades / $count;
        } else {
            $result = 0;
        }

        return $result;
    }

}
