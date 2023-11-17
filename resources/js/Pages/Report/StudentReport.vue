<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <!-- Кнопка для сортировки по всем столбцам -->
                        <button @click="toggleSortDirection">Средний бал по предметам</button>

                        <!-- Таблица данных -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th @click="sort('users_name')">Имя {{
                                        sortBy === 'users_name' ? (sortDirection === 'asc' ? '↑' : '↓') : ''
                                    }}
                                </th>
                                <th @click="sort('users_last')">ФАмилия {{
                                        sortBy === 'users_last' ? (sortDirection === 'asc' ? '↑' : '↓') : ''
                                    }}
                                </th>
                                <th @click="sort('users_patronymic')">Отчество {{
                                        sortBy === 'users_patronymic' ? (sortDirection === 'asc' ? '↑' : '↓') : ''
                                    }}
                                </th>
                                <th @click="sort('group')">Группа {{
                                        sortBy === 'group' ? (sortDirection === 'asc' ? '↑' : '↓') : ''
                                    }}
                                </th>
                                <th @click="sort('subject')">Предмет
                                    {{ sortBy === 'subject' ? (sortDirection === 'asc' ? '↑' : '↓') : '' }}
                                </th>
                                <th @click="sort('average_grade')">Средний бал {{
                                        sortBy === 'average_grade' ? (sortDirection === 'subject' ? '↑' : '↓') : ''
                                    }}
                                </th>
                                <!-- Добавьте другие заголовки столбцов по необходимости -->
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Отображение отсортированных данных -->
                            <tr v-for="item in sortedData" :key="item.id">
                                <td>{{ item.users_name }}</td>
                                <td>{{ item.users_last }}</td>
                                <td>{{ item.users_patronymic }}</td>
                                <td>{{ item.group }}</td>
                                <td>{{ item.subject }}</td>
                                <td>{{ item.average_grade }}</td>
                                <!-- Отображение других полей данных по необходимости -->
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head, AuthenticatedLayout},
    data() {
        return {
            // Данные для таблицы
            data: [],
            // Параметры сортировки
            sortBy: '',
            sortDirection: 'asc',
        };
    },
    computed: {
        // Отсортированные данные
        sortedData() {
            if (!this.sortBy) {
                return this.data;
            }

            const direction = this.sortDirection === 'asc' ? 1 : -1;
            return [...this.data].sort((a, b) =>
                a[this.sortBy] > b[this.sortBy] ? direction : -direction
            );
        },
    },
    created() {
        this.fetchData();
        console.log(this.data)
    },
    methods: {
        fetchData() {
            // Здесь можно использовать библиотеку axios или другие средства для выполнения HTTP-запросов
            // Пример с axios:
            axios.get(`avg/${this.$page.props.id}`, {
                headers: {
                    'Accept': 'application/json',
                },
            })
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error('Ошибка при получении данных', error);
                });
        },
        // Смена направления сортировки
        toggleSortDirection() {
            this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
        },
        // Сортировка по столбцу
        sort(column) {
            if (this.sortBy === column) {
                this.toggleSortDirection();
            } else {
                this.sortBy = column;
                this.sortDirection = 'asc';
            }
        },
    },
};
</script>

<style scoped>
.table {
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #dddddd;
    border-collapse: collapse;
}

.table th {
    font-weight: bold;
    padding: 5px;
    background: #efefef;
    border: 1px solid #dddddd;
}

.table td {
    border: 1px solid #dddddd;
    padding: 5px;
}
</style>
