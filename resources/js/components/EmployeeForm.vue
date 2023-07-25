<template>
  <div>
    <h2 v-if="isNewProduct">Add Product</h2>
    <h2 v-else>Edit Product</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Colaborador:</label>
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
          <label for="cpf" class="form-label">CPF:</label>
          <input
            class="form-control"
            type="text"
            id="cpf"
            placeholder="CPF"
            v-model="employee.cpf"
            required
          />
        </div>
        <div class="mb-3">
          <label for="daytime" class="form-label">Hora inicial:</label>
          <input
            class="form-control"
            type="text"
            id="daytime"
            v-model="employee.daytime"
            required
          />
        </div>
        <div class="mb-3">
          <label for="nightTime" class="form-label">Hora final:</label>
          <input
            class="form-control"
            type="text"
            id="nightTime"
            v-model="employee.nightTime"
            required
          />
        </div>
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
