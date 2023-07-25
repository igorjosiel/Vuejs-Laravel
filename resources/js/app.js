import { createApp } from 'vue';
import VueTheMask from 'vue-the-mask';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import EmployeeList from './components/EmployeeList.vue';
import EmployeeForm from './components/EmployeeForm.vue';
import Employee from './components/Employee.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: EmployeeList },
        { path: '/colaborador/criar', component: EmployeeForm },
        { path: '/colaborador/:id', component: Employee },
        { path: '/colaborador/:id/editar', component: EmployeeForm },
    ]
});

const app = createApp(App);
app.use(router);
app.use(VueTheMask);
app.mount('#app');
