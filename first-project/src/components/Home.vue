<script>
import axios from "axios";
export default {
  name: "HomePage",

  data() {
    return {
      loader: false,
      response: [],
    };
  },
  methods: {
    async fetchData() {
      this.loader = true;
      try {
        const ajax = await axios({
          method: "get",
          url: "https://jsonplaceholder.typicode.com/posts",
        });
        this.response = ajax.data;
      } catch (err) {
        console.error("Error fetching data:", err);
      } finally {
        this.loader = false;
      }
    },
  },
};
</script>

<template>
  <div class="container py-4">
    <!-- Hero Header Section -->
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border border-light">
      <div class="container-fluid py-2">
        <h1 class="display-5 fw-bold text-success">Vue.js Learning Hub</h1>
        <p class="col-md-8 fs-5 text-muted">
          Welcome to your Vue.js playground. This workspace demonstrates fundamentals like API integration, Composition API, custom form validations, dynamic routing, and third-party package usage.
        </p>
        <hr class="my-4 text-muted opacity-25">
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-success btn-lg px-4" @click="fetchData()" :disabled="loader">
            <span v-if="loader" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            <i v-else class="fas fa-cloud-download-alt me-2"></i>Fetch API Data (GET)
          </button>
        </div>
      </div>
    </div>

    <!-- Loading Spinner -->
    <div v-if="loader" class="d-flex justify-content-center my-5">
      <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Card Grid -->
    <div class="row g-4" v-else-if="response.length > 0">
      <div class="col-md-6 col-lg-4" v-for="(data, index) in response" :key="index">
        <div class="card h-100 shadow-sm border border-light transition-hover">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Post #{{ data.id }}</span>
              <span class="text-muted small">User ID: {{ data.userId }}</span>
            </div>
            <h5 class="card-title text-dark fw-bold mb-2">{{ data.title }}</h5>
            <p class="card-text text-secondary flex-grow-1">{{ data.body }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.transition-hover {
  transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.transition-hover:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
}
.bg-success-subtle {
  background-color: #d1e7dd;
}
</style>

