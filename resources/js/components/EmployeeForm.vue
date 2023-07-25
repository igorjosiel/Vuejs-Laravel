<template>
  <div>
    <h2 v-if="isNewProduct">Add Product</h2>
    <h2 v-else>Edit Product</h2>
      <form @submit.prevent="submitForm" novalidate>
        <fieldset>
            <legend>Dados pessoais</legend>
            <div class="mb-3">
                <label
                    for="name"
                    class="form-label"
                    aria-label="Campo para digitar o nome do colaborador">
                        Colaborador:
                </label>
                <input
                    class="form-control"
                    type="text"
                    id="name"
                    placeholder="Colaborador"
                    v-model="employee.name"
                    required
                />
            </div>
            <div class="mb-3">
                <label
                    for="cpf"
                    class="form-label"
                    aria-label="Campo para digitar o cpf do colaborador">
                        CPF:
                </label>
                <input
                    class="form-control"
                    type="text"
                    id="cpf"
                    placeholder="CPF"
                    v-model="employee.cpf"
                    size="14"
                    maxlength="14"
                    required
                />
            </div>
        </fieldset>
        <fieldset>
            <legend>Intervalo de horas trabalhado:</legend>
            <div class="mb-3">
                <label
                    for="daytime"
                    class="form-label"
                    aria-label="Campo para digitar a hora inicial de trabalho">
                        Hora inicial:
                </label>
                <input
                    class="form-control"
                    type="text"
                    id="daytime"
                    v-model="employee.daytime"
                    size="5"
                    maxlength="5"
                    required
                />
            </div>
            <div class="mb-3">
                <label
                    for="nightTime"
                    class="form-label"
                    aria-label="Campo para digitar a hora final de trabalho">
                        Hora final:
                </label>
                <input
                    class="form-control"
                    type="text"
                    id="nightTime"
                    v-model="employee.nightTime"
                    size="5"
                    maxlength="5"
                    required
                />
            </div>
        </fieldset>

        <button type="submit" v-if="isNewProduct" class="btn btn-primary">Calcular</button>
        <button type="submit" v-else class="btn btn-primary">Update Product</button>
      </form>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                employee: {
                    name: '',
                    cpf: '',
                    initialTime: 0,
                    finalTime: 0,
                }
            }
        },
        computed: {
            isNewProduct() {
                return !this.$route.path.includes('editar');
            }
        },
        async created() {
            if (!this.isNewProduct) {
                const response = await axios.get(`/api/employees/${this.$route.params.id}`);

                this.product = response.data;
            }
        },
        methods: {
            async submitForm() {
                try {
                    if (this.isNewProduct) {
                        await axios.post('/api/employees', this.employee);
                    } else {
                        await axios.put(`/api/employees/${this.$route.params.id}`, this.employee);
                    }

                    this.$router.push('/');
                } catch (error) {
                    console.error(error);
                }
            }
        }
    }
</script>

<style scoped>
    legend {
        font-size: 1.1rem;
        font-weight: bold;
    }
</style>
