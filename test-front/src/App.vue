<template>
  <div>
    <h2>Task management</h2>
    <form @submit.prevent="submitForm">
      <div>
        <label for="taskTitle">Task Title:</label>
        <input type="text" id="taskTitle" v-model="taskTitle" required />
      </div>
      <div>
        <label for="taskDescription">Task description:</label>
        <input type="text" id="taskDescription" v-model="taskDescription" required />
      </div>
      <button type="submit">Submit</button>
    </form>
    <div v-if="submitForm">
      <h3>Submitted Data:</h3>
      <p>Task Title: {{ taskTitle }}</p>
      <p>Task description: {{ taskDescription }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'DataForm',
  data() {
    return {
      formData: {
        title: '',
        description: '',
      },
      responseMessage: '',
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('http://127.0.0.1:8080/api/create.php', this.formData);
        this.responseMessage = response.data; // Adjust based on your API response structure
      } catch (error) {
        console.error('Error submitting form:', error);
        this.responseMessage = 'An error occurred while submitting the form.';
      }
    },
  },
};
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  max-width: 300px;
}
label {
  margin-bottom: 5px;
}
input {
  margin-bottom: 15px;
}
button {
  padding: 10px;
}
</style>