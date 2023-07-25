import { createApp } from 'vue';
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
        { path: '/products/create', component: EmployeeForm },
        { path: '/products/:id', component: Employee },
        { path: '/products/:id/edit', component: EmployeeForm },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');
