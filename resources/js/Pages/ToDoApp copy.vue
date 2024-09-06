<template>
<Head title="Log in" />
  <div>
    <!-- Header -->
    <header class="bg-primary text-white text-center py-3">
      <h1>Welcome to the To-Do App</h1>
    </header>

    <!-- Main Section -->
    <section class="vh-100" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
              <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3">PHP-Simple To Do List App</h4>

                <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" @submit.prevent="saveTask">
                  <div class="col-12">
                    <div class="form-outline">
                      <input type="text" v-model="task" class="form-control"  placeholder="Enter a task here"/>
                    </div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary">Save</button>
                  </div>

                  <div class="col-12">
                    <button @click.prevent="getTasks" class="btn btn-warning">Get tasks</button>
                  </div>
                </form>

                <table class="table mb-4">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Todo item</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(todo, index) in todos" :key="index">
                     
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ todo.name }}</td>
                      <td>{{ todo.status }}</td>
                      <td>
                        <button @click="deleteTask(index)" class="btn btn-danger">Delete</button>
                        <button v-if="todo.status !== 'Finished'" @click="markAsFinished(index)" class="btn btn-success ms-1">Finish</button>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
      <p>&copy; 2024 To-Do App. All Rights Reserved.</p>
    </footer>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      task: '',
      todos: [],
    };
  },
  mounted() {
    this.getTasks(); // Fetch tasks when the component is mounted
  },
  methods: {
    async saveTask() {
      if (this.task && !this.todos.find(todo => todo.name === this.task)) {
        try {
          const response = await axios.post('/api/todos', { name: this.task });
          this.todos.push(response.data.task);
          this.task = '';
        } catch (error) {
          console.error('Error saving task:', error);
        }
      } else {
        alert('Task already exists.');
      }
    },
    async getTasks() {
      try {
        const response = await axios.get('/api/todos');
        this.todos = response.data;
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    },
    async deleteTask(index) {
      const confirmed = confirm('Are you sure you want to delete this task?');
      if (!confirmed) return;

      const taskId = this.todos[index].id;
      try {
        await axios.delete(`/api/todos/${taskId}`);
        this.todos.splice(index, 1);
      } catch (error) {
        console.error('Error deleting task:', error);
      }
    },
    async markAsFinished(index) {
      const taskId = this.todos[index].id;
      try {
        await axios.put(`/api/todos/${taskId}`);
        this.todos[index].status = 'Finished';
      } catch (error) {
        console.error('Error updating task status:', error);
      }
    },
  },
};
</script>

