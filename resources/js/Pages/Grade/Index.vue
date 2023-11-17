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
                    <h2>Средний балл групп</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Группа</th>
                            <th>Предмет</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="subject in $page.props.subjects" :key="subject.id">
                            <td>{{ subject.id }} </td>
                            <td>{{ subject.name }}</td>
                            <td>{{ subject.group.name }}</td>
                            <td>
<!--                                <NavLink-->
<!--                                    :href="route('grade.create',{ subject_id: subject.subject_id , group_id: subject.group_id } )">-->
<!--                                    Поставить оценку-->
<!--                                </NavLink>-->
                                <h1>
                                    <NavLink
                                        :href="route('grade.show.list',{subject_id: subject.id, group_id: subject.group.id})">
                                        Посмотреть
                                    </NavLink>
                                </h1>
                                <h1>
                                    <!--                                    <NavLink  method="delete" :href="route('grade.destroy',{grade,id:grade.id})">Удалить</NavLink>-->
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
