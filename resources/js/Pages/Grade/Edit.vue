<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    data() {
        return {
            form: useForm({
                student_name: this.$page.props.grade.user.name,
                group_id: this.$page.props.grade.user.group_id,
                subject_id: this.$page.props.grade.subject_id,
                grade: this.$page.props.grade.grade,
                grade_id: this.$page.props.grade.id,
            }),
        }
    },
    components: {
        PrimaryButton,
        Link,
        InputError,
        TextInput,
        InputLabel,
        AuthenticatedLayout, Head
    },
    methods: {
        submit() {
            this.form.put(route('grade.update',  this.$page.props.grade));
        }
    }
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
                    <h4 class="font-13">Поставить Оценку</h4>
                    <form class="p-2" @submit.prevent="submit">
                        <h1>Вы ставите оценку студенту {{ this.$page.props.grade.user.name }}
                            {{ this.$page.props.grade.user.last_name }}
                            {{ this.$page.props.grade.user.patronymic }} по предмету
                            {{ this.$page.props.grade.subject.name }}
                        </h1>

                        <br>
                        <br>
                        <InputLabel for="student" value="Student"/>
                        <br>


                        <TextInput
                            id="grade"
                            type="text"
                            name="student"
                            class="mt-1 block w-full"
                            v-model="form.student_name"
                            required
                            autofocus
                            autocomplete="student"
                        />

                        <InputError class="mt-2" :message="form.errors.student"/>


                        <InputLabel for="grade" value="Grade"/>

                        <TextInput
                            id="grade"
                            type="number"
                            name="grade"
                            class="mt-1 block w-full"
                            v-model="form.grade"
                            required
                            autofocus
                            autocomplete="grade"
                        />

                        <InputError class="mt-2" :message="form.errors.grade"/>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing">
                                Добавить
                            </PrimaryButton>
                        </div>
                    </form>

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
