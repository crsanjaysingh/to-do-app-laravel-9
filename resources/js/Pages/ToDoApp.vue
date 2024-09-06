<template>
  <div>
    <!-- Main Section -->
    <section class="vh-100" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
              <div class="card-body p-4">
                <h4 class="text-center my-3 pb-3">PHP-Simple To Do List App</h4>

                <!-- Task input form -->
                <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" @submit.prevent="saveTask">
                  <div class="row">
                    <div class="col-8">
                      <div class="form-outline">
                        <input
                          type="text"
                          v-model="task"
                          class="form-control"
                          placeholder="Enter a task here"
                        />
                      </div>
                    </div>

                    <div class="col-4">
                      <button class="btn btn-primary mr-1">Save</button>
                    </div>
                    <div class="col-12">
                      <!-- Error message for empty or duplicate task -->
                      <p v-if="errorMessage" class="text-danger">{{ errorMessage }}</p>
                    </div>
                  </div>
                </form>

                <!-- Filter buttons -->
                <div class="d-flex justify-content-center mb-4">
                  <button @click="filterTasks('all')" class="btn btn-secondary mx-1">Show All</button>
                  <button @click="filterTasks('pending')" class="btn btn-info mx-1">Pending</button>
                  <button @click="filterTasks('finished')" class="btn btn-success mx-1">Finished</button>
                </div>

                <!-- Task list -->
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
                    <tr v-for="(todo, index) in filteredTodos" :key="index">
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
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      task: '',
      todos: [],
      filteredTodos: [],
      filterType: 'all', // To track the current filter
      errorMessage: '', // For validation error messages
    };
  },
  mounted() {
    this.getTasks(); // Fetch tasks when the component is mounted
  },
  methods: {
    // Save task method with validation for empty and duplicate tasks
    async saveTask() {
      this.errorMessage = ''; // Clear previous error message

      // Check if the task input is empty
      if (!this.task.trim()) {
        this.errorMessage = 'Please enter a task.';
        return;
      }

      // Check for duplicate task
      const isDuplicate = this.todos.some((todo) => todo.name.toLowerCase() === this.task.toLowerCase());
      if (isDuplicate) {
        this.errorMessage = 'This task already exists.';
        return;
      }

      // Proceed to save the task if no errors
      try {
        const response = await axios.post('/api/todos', { name: this.task });
        this.todos.push(response.data.task);
        this.task = ''; // Clear the input after saving
        this.applyFilter(); // Reapply filter after adding a new task
      } catch (error) {
        console.error('Error saving task:', error);
      }
    },

    // Fetch all tasks from the backend
    async getTasks() {
      try {
        const response = await axios.get('/api/todos');
        this.todos = response.data;
        this.applyFilter(); // Apply filter after fetching tasks
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    },

    // Delete task with confirmation
    async deleteTask(index) {
      const confirmed = confirm('Are you sure you want to delete this task?');
      if (!confirmed) return;

      const taskId = this.todos[index].id;
      try {
        await axios.delete(`/api/todos/${taskId}`);
        this.todos.splice(index, 1); // Remove the task from the list
        this.applyFilter(); // Reapply filter after deletion
      } catch (error) {
        console.error('Error deleting task:', error);
      }
    },

    // Mark task as finished
    async markAsFinished(index) {
      const taskId = this.todos[index].id;
      try {
        await axios.put(`/api/todos/${taskId}`);
        this.todos[index].status = 'Finished'; // Update task status
        this.applyFilter(); // Reapply filter after updating the task
      } catch (error) {
        console.error('Error updating task status:', error);
      }
    },

    // Filter tasks based on the status
    filterTasks(type) {
      this.filterType = type;
      this.applyFilter();
    },

    // Apply filter based on the selected filter type
    applyFilter() {
      if (this.filterType === 'all') {
        this.filteredTodos = this.todos;
      } else if (this.filterType === 'finished') {
        this.filteredTodos = this.todos.filter((todo) => todo.status === 'Finished');
      } else if (this.filterType === 'pending') {
        this.filteredTodos = this.todos.filter((todo) => todo.status !== 'Finished');
      }
    },
  },
};
</script>

<style scoped>
/* Add some padding and margin for a better layout */
.text-danger {
  margin-top: 5px;
}
</style>
