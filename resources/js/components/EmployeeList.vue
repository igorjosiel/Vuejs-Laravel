<template>
    <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Colaborador</th>
                <th scope="col">CPF</th>
                <th scope="col">Horas diurnas</th>
                <th scope="col">Horas noturnas</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees" :key="employee.id">
                    <td>{{ employee.id }}</td>
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.cpf }}</td>
                    <td>{{ employee.daytime }}</td>
                    <td>{{ employee.nightTime }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/employees/${employee.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/employees/${employee.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>

                        <button @click="deleteEmployee(employee.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                employees: []
            }
        },
        async created() {
            try {
                const response = await axios.get('/api/employees');

                this.employees = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        methods: {
            async deleteEmployee(id) {

            try {
                await axios.delete(`/api/employees/${id}`);

                this.employees = this.employees.filter(employee => employee.id !== id);
            }  catch (error) {
                    console.error(error);
                }
            }
        }
    }
</script>
