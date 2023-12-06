<template>
    <IndexHeader></IndexHeader>
    <div class="container">
        <main>
            <div>
                <h2 class="text-center">
                    Ваши финансы:
                </h2>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-6 main-finance">
                            <h5 class="text-center">
                                Ваши доходы
                            </h5>
                            <div class="mt-4">
                                <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#income"
                                        @click.prevent="getCategoryIncomes">
                                    Добавить доходы
                                </button>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Значение</th>
                                    <th scope="col">Кнопка</th>
                                </tr>
                                </thead>
                                <tbody v-if="incomes && incomes.length > 0">
                                <tr v-for="(income, index) in incomes" :key="index">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ income.category.title }}</td>
                                    <td>{{ income.value }} руб.</td>
                                    <td>
                                        <button class="btn btn-danger" @click="deleteOneIncome(income.id)">
                                            Удалить
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Итог:
                                        {{ this.incomes.reduce((total, income) => total + income.value, 0) }} руб.
                                    </td>
                                </tr>
                                </tbody>
                                <tbody v-else>
                                <tr>
                                    <td class="not-text" colspan="4">Список пуст</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 main-finance">
                            <h5 class="text-center">
                                Ваши расходы
                            </h5>
                            <div class="mt-4">
                                <button type="button" class="btn btn-secondary mb-3 float-end me-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#expenses" @click.prevent="getCategoryExpenses">
                                    Добавить расходы
                                </button>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Значение</th>
                                    <th scope="col">Кнопка</th>
                                </tr>
                                </thead>
                                <tbody v-if="expenses && expenses.length > 0">
                                <tr v-for="(expense, index) in expenses" :key="index">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ expense.category.title }}</td>
                                    <td>{{ expense.value }} руб.</td>
                                    <td>
                                        <button class="btn btn-danger" @click="deleteOneExpense(expense.id)">
                                            Удалить
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Итог:
                                        {{ this.expenses.reduce((total, expense) => total + expense.value, 0) }} руб.
                                    </td>
                                </tr>
                                </tbody>

                                <tbody v-else>
                                <tr>
                                    <td class="not-text" colspan="4">Список пуст</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4" v-if="(expenses && expenses.length > 0) && (incomes && incomes.length > 0)">
                            <p>
                                Итоговое значение составляет:
                                <b>
                                    {{ (this.incomes.reduce((total, income) => total + income.value, 0)) - (this.expenses.reduce((total, expense) => total + expense.value, 0)) }}
                                </b>
                                руб.
                            </p>
                            <button class="btn btn-secondary" @click.prevent="getExportExcel()">
                                Экспортировать данные в Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <IndexFooter></IndexFooter>

    <!-- Модальное окно для доходов -->
    <div class="modal fade" id="income" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление доходов</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div v-if="errors.length > 0" class="alert alert-danger">
                        <ul class="m-0">
                            <li v-for="error in errors" :key="error">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <div>
                        Введите сумму:
                        <input class="input-group-text w-100" v-model="value">
                    </div>
                    <div class="mt-4">
                        Выберите подходящую категорию:
                        <select class="form-select" aria-label="Default select example" v-model="selectedCategory">
                            <option v-for="category in categoryIncomes" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" @click.prevent="postIncomes">Сохранить</button>
                </div>
            </div>
        </div>
        <div class="alert-container" v-if="successMessage">
            <div class="alert alert-secondary" role="alert">
                {{ successMessage }}
            </div>
        </div>
    </div>

    <!-- Модальное окно для расходов -->
    <div class="modal fade" id="expenses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление расходов</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div v-if="errors.length > 0" class="alert alert-danger">
                        <ul class="m-0">
                            <li v-for="error in errors" :key="error">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <div>
                        Введите сумму:
                        <input class="input-group-text w-100" v-model="value">
                    </div>
                    <div class="mt-4">
                        Выберите подходящую категорию:
                        <select class="form-select" aria-label="Default select example" v-model="selectedCategory">
                            <option v-for="category in categoryExpenses" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" @click.prevent="postExpenses">Сохранить</button>
                </div>
            </div>
        </div>
        <div class="alert-container" v-if="successMessage">
            <div class="alert alert-secondary" role="alert">
                {{ successMessage }}
            </div>
        </div>
    </div>

    <!-- Окно при успешном удалении -->
    <div class="alert-container" v-if="deleteMessage">
        <div class="alert alert-danger" role="alert">
            {{ deleteMessage }}
        </div>
    </div>
</template>

<script>

import IndexHeader from "@/components/header/Index.vue";
import IndexFooter from "@/components/footer/Index.vue";

export default {
    components: {IndexFooter, IndexHeader},
    name: "IndexFinance",

    data() {
        return {
            value: 0,
            incomes: null,
            expenses: null,
            selectedCategory: null,
            categoryIncomes: null,
            categoryExpenses: null,
            errors: [],
            successMessage: null,
            deleteMessage: null,
        }
    },

    mounted() {
        this.getIncomes();
        this.getExpenses();
    },

    methods: {

        // Получение всех доходов
        getIncomes() {
            axios.get('/api/income/all')
                .then(res => {
                    this.incomes = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Получение всех расходов
        getExpenses() {
            axios.get('/api/expenses/all')
                .then(res => {
                    this.expenses = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Получение категорий для доходов
        getCategoryIncomes() {
            axios.get('/api/category-incomes')
                .then(res => {
                    this.categoryIncomes = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Получение категорий для расходов
        getCategoryExpenses() {
            axios.get('/api/category-expenses')
                .then(res => {
                    this.categoryExpenses = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Отправка данных с новыми доходами
        postIncomes() {
            this.errors = [];

            axios.post('/api/income', {value: Number(this.value), selectedCategory: this.selectedCategory})
                .then(res => {
                    this.value = 0;
                    this.selectedCategory = null;

                    this.incomes = [];
                    this.getIncomes();

                    this.successMessage = 'Данные успешно добавлены';
                    setTimeout(() => {
                        this.successMessage = null;
                    }, 3000);
                })
                .catch(error => {
                    const serverErrors = error.response.data.errors;

                    Object.keys(serverErrors).forEach(field => {
                        serverErrors[field].forEach(errorMessage => {
                            this.errors.push(errorMessage);
                        });
                    });
                });
        },

        // Отправка данных с новыми расходами
        postExpenses() {
            this.errors = [];

            axios.post('/api/expenses', {value: Number(this.value), selectedCategory: this.selectedCategory})
                .then(res => {
                    this.value = 0;
                    this.selectedCategory = null;

                    this.expenses = [];
                    this.getExpenses();

                    this.successMessage = 'Данные успешно добавлены';
                    setTimeout(() => {
                        this.successMessage = null;
                    }, 3000);

                })
                .catch(error => {
                    const serverErrors = error.response.data.errors;

                    Object.keys(serverErrors).forEach(field => {
                        serverErrors[field].forEach(errorMessage => {
                            this.errors.push(errorMessage);
                        });
                    });
                });
        },

        // Удаление выбранного дохода
        deleteOneIncome(incomeId) {
            axios.delete(`/api/income/delete/${incomeId}`)
                .then(res => {
                    this.deleteMessage = 'Данные успешно удалены';
                    setTimeout(() => {
                        this.deleteMessage = null;
                    }, 2000);

                    this.incomes = null;
                    this.getIncomes();

                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Удаление выбранного расхода
        deleteOneExpense(expenseId) {
            axios.delete(`/api/expenses/delete/${expenseId}`)
                .then(res => {
                    this.deleteMessage = 'Данные успешно удалены';
                    setTimeout(() => {
                        this.deleteMessage = null;
                    }, 2000);
                    this.expenses = null;
                    this.getExpenses();
                })
                .catch(error => {
                    console.error(error);
                });
        },

        // Экспорт в эксель
        getExportExcel() {
            axios.get(`/api/export`, { responseType: 'arraybuffer' })
                .then(res => {
                    const blob = new Blob([res.data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'finance.xlsx';
                    link.click();
                })
                .catch(error => {
                    console.error(error);
                });
        },


    },
};
</script>
<style>
.alert-container {
    position: fixed;
    bottom: 10px;
    right: 10px;
    z-index: 1001;
}

.alert-secondary {
    background: green;
    color: white;
}

.alert-danger {
    background: red;
    color: white;
}

.not-text {
    text-align: center;
}

@media (max-width: 992px) {
    .main-finance {
        width: 100%;
    }
}
</style>
