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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teacher</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>Учителя</h2>
                    <h1>
                        <NavLink :href="route('teacher.create')">Добавить учителя</NavLink>
                    </h1>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="teacher in $page.props.teachers" :key="teacher.id">
                            <td>{{ teacher.id }}</td>
                            <td>{{ teacher.name }}</td>
                            <td>{{ teacher.last_name }}</td>
                            <td>{{ teacher.patronymic }}</td>
                            <td>
                                <h1>
                                    <NavLink :href="route('teacher.edit',{teacher,id:teacher.id})">Изменить</NavLink>
                                </h1>
                                <h1>
                                    <NavLink  method="delete" :href="route('teacher.destroy',{teacher,id:teacher.id})">Удалить</NavLink>
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
