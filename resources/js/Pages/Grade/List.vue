<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import {data} from "autoprefixer";

export default {
    computed: {
        data() {
            return data
        }
    },
    components: {
        NavLink,
        PrimaryButton,
        Modal,
        AuthenticatedLayout, Head
    },
};
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Средний балл группы {{ $page.props.name_group.name }} по предмету {{ $page.props.name_subject.name }} равняется {{ $page.props.avg}} </h2>
                    <h1>
                        <NavLink
                            :href="route('grade.create',{ subject_id: $page.props.subject_id, group_id:$page.props.group_id})">
                            Поставить оценку
                        </NavLink>
                    </h1>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th> Отчества</th>
                            <th> Бал</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="result in $page.props.results" :key="result.user_id">
                            <td>{{ result.user_id }}</td>
                            <td>{{ result.user_name }}</td>
                            <td>{{ result.user_last_name }}</td>
                            <td>{{ result.users_patronymic }}</td>
                            <td>{{ result.grades_grade }}</td>
                            <td>
                                <NavLink
                                    :href="route('grade.edit',{grade: result.grade,grade_id:result.grades_id} )">
                                    Исправить оценку
                                </NavLink>
                                <h1>
                                    <NavLink method="delete"
                                             :href="route('grade.destroy',{grade:result.grade,grade_id:result.grades_id,group_id:result.users_group_id})">
                                        Удалить
                                    </NavLink>
                                </h1>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>
/* Add your styles here */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}
</style>
