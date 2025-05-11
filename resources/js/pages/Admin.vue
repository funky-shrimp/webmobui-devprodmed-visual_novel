<script setup>
import { ref } from "vue";
import axios from "axios"; // Ensure you have the axios instance configured

const email = ref("");
const password = ref("");
const errorMessage = ref("");

const login = async () => {
    try {
        // Send login request to the Breeze API
        await axios.post("/login", {
            email: email.value,
            password: password.value,
        });
        // Redirect to the admin dashboard or reload the page
        window.location.href = "/"; // Change this to your admin dashboard route if needed
    } catch (error) {
        // Handle login errors
        errorMessage.value =
            error.response?.data?.message || "Login failed. Please try again.";
    }
};
</script>

<template>
    <div class="admin-login">
        <h1>Admin Login</h1>
        <form @submit.prevent="login">
            <div>
                <label for="email">Email:</label>
                <input
                    id="email"
                    v-model="email"
                    type="email"
                    placeholder="Enter your email"
                    required
                />
            </div>
            <div>
                <label for="password">Password:</label>
                <input
                    id="password"
                    v-model="password"
                    type="password"
                    placeholder="Enter your password"
                    required
                />
            </div>
            <button type="submit">Login</button>
            <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
        </form>
    </div>
</template>

<style scoped>
.admin-login {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.admin-login h1 {
    text-align: center;
    margin-bottom: 20px;
}

.admin-login form div {
    margin-bottom: 15px;
}

.admin-login label {
    display: block;
    margin-bottom: 5px;
}

.admin-login input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.admin-login button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.admin-login button:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    text-align: center;
    margin-top: 10px;
}
</style>
