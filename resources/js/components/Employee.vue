<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Colaborador:</h5>
        <h6>{{ employee.name }}</h6>
        <h5 id="associating-form-text-with-form-controls">CPF:</h5>
        <p>{{ employee.cpf }}</p>
        <h5 id="associating-form-text-with-form-controls">Horas diurnas:</h5>
        <p>{{ employee.daytime }}</p>
        <h5 id="associating-form-text-with-form-controls">Horas noturnas:</h5>
        <p>{{ employee.daytime }}</p>
        <router-link :to="`/colaborador/${employee.id}/editar`" class="btn btn-primary">Editar</router-link>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                employee: {}
            }
        },
        async created() {
            try {
                const response = await axios.get(`/api/employees/${this.$route.params.id}`);

                this.employee = response.data;
            } catch (error) {
                console.error(error);
            }
        }
    }
</script>
