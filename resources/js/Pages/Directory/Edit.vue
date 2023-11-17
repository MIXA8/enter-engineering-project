<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    props: {
        directory: Object,
    },
    data() {
        return {
            form: useForm({
                id: this.directory.id,
                name: this.directory.name,
                email: this.directory.email,
                role: this.directory.role,
                login: this.directory.login,
                patronymic: this.directory.patronymic,
                last_name: this.directory.last_name,
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
            this.form.put(route('directory.update',this.directory), {
                onFinish: () => form.reset('password', 'password_confirmation'),
            });
        }
    }
};
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Directory</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h4 class="font-13">Изменить директора</h4>
                    <form class="p-2" @submit.prevent="submit">

                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>


                        <InputLabel for="login" value="Login"/>

                        <TextInput
                            id="login"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.login"
                            required
                            autofocus
                            autocomplete="login"
                        />

                        <InputError class="mt-2" :message="form.errors.login"/>

                        <InputLabel for="last_name" value="Last name"/>

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autofocus
                            autocomplete="last_name"
                        />

                        <InputError class="mt-2" :message="form.errors.last_name"/>

                        <InputLabel for="patronymic" value="Patronymic"/>

                        <TextInput
                            id="patronymic"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.patronymic"
                            required
                            autofocus
                            autocomplete="patronymic"
                        />

                        <InputError class="mt-2" :message="form.errors.patronymic"/>

                        <InputLabel for="email" value="Email"/>

                        <TextInput
                            id="email"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="email"
                        />

                        <InputError class="mt-2" :message="form.errors.email"/>



                        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing">
                                Изменить
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
