<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    props: {
        subject: Object,
        groups: Array,
    },
    data() {
        return {
            form: useForm({
                id: this.subject.id,
                name: this.subject.name,
                group: this.subject.group.id,
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
            this.form.put(route('subject.update', this.subject));
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
                    <h4 class="font-13">Добавить предмет</h4>
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

                        <InputLabel for="group" value="Group"/>

                        <select id="group" class="mt-1 block w-full"
                                v-model="form.group"
                                required
                                autofocus >
                            <option :value="group.id" v-for="group in $page.props.groups" :key="group.id">{{ group.name }}</option>
                            <!-- Добавьте другие варианты, если необходимо -->
                        </select>

                        <InputError class="mt-2" :message="form.errors.group"/>

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
