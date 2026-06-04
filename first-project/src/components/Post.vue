<script>
import axios from "axios";
export default {
  name: "PostPage",

  data() {
    return {
      save: false,
      id: "",
      cardIndex: "",
      userId: "",
      title: "",
      body: "",
      response: [],
      loader: false,
    };
  },

  methods: {
    async postData() {
      if (!this.title || !this.body || !this.userId) {
        alert("Please fill in all fields.");
        return;
      }
      this.loader = true;
      try {
        const response = await axios({
          method: "post",
          url: "https://jsonplaceholder.typicode.com/posts",
          data: {
            title: this.title,
            body: this.body,
            userId: this.userId,
          },
        });
        this.response.unshift(response.data);
        this.reset();
      } catch (err) {
        console.error(err);
        alert("Something went wrong");
      } finally {
        this.loader = false;
      }
    },

    async deleteRequest(data, index) {
      if (!confirm("Are you sure you want to delete this post?")) return;
      this.loader = true;
      let string = JSON.stringify(data);
      let deleteData = JSON.parse(string);
      let id = deleteData.id;
      try {
        await axios({
          method: "delete",
          url: "https://jsonplaceholder.typicode.com/posts/" + id,
        });
        this.response.splice(index, 1);
      } catch (err) {
        console.error(err);
        alert("Failed to delete post");
      } finally {
        this.loader = false;
      }
    },

    edit(data, index) {
      this.save = true;
      let string = JSON.stringify(data);
      let editData = JSON.parse(string);

      this.userId = editData.userId;
      this.title = editData.title;
      this.body = editData.body;
      this.id = editData.id;
      this.cardIndex = index;
      
      // Scroll form into view on mobile
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    reset() {
      this.userId = "";
      this.title = "";
      this.body = "";
      this.save = false;
    },

    async updateData() {
      if (!this.title || !this.body || !this.userId) {
        alert("Please fill in all fields.");
        return;
      }
      this.loader = true;
      try {
        const response = await axios({
          method: "put",
          url: "https://jsonplaceholder.typicode.com/posts/1",
          data: {
            id: this.id,
            userId: this.userId,
            title: this.title,
            body: this.body,
          },
        });
        this.response[this.cardIndex] = response.data;
        this.reset();
      } catch (err) {
        console.error(err);
        alert("Failed to update post");
      } finally {
        this.loader = false;
      }
    },
  },
};
</script>

<template>
  <div class="container-fluid py-4 bg-light min-vh-100">
    <div class="row g-4">
      <!-- Left Sidebar: Form Builder -->
      <div class="col-12 col-md-4 col-lg-3">
        <div class="card bg-dark text-white p-4 border-0 shadow-lg rounded-4 sticky-md-top" style="top: 80px;">
          <div class="mb-4">
            <h4 class="text-success fw-bold mb-1">
              <i class="fas" :class="save ? 'fa-edit' : 'fa-plus-circle'"></i> 
              {{ save ? 'Edit Post' : 'New Post' }}
            </h4>
            <p class="text-muted small">Submit data using POST/PUT methods</p>
          </div>

          <form @submit.prevent="save ? updateData() : postData()">
            <div class="mb-3">
              <label class="form-label text-light small">User ID</label>
              <input
                type="number"
                placeholder="Enter User ID"
                class="form-control bg-secondary bg-opacity-20 text-white border-secondary"
                v-model="userId"
                required
              />
            </div>

            <div class="mb-3">
              <label class="form-label text-light small">Post Title</label>
              <input
                type="text"
                placeholder="Post Title"
                class="form-control bg-secondary bg-opacity-20 text-white border-secondary"
                v-model="title"
                required
              />
            </div>

            <div class="mb-4">
              <label class="form-label text-light small">Post Content</label>
              <textarea
                placeholder="Post Body"
                class="form-control bg-secondary bg-opacity-20 text-white border-secondary"
                v-model="body"
                rows="4"
                required
              ></textarea>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg rounded-pill" v-if="!save">
                Create Post
              </button>
              <div v-else class="row g-2">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary w-100 rounded-pill">
                    Save
                  </button>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-outline-warning w-100 rounded-pill" @click="reset">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Right Main Content: Post List -->
      <div class="col-12 col-md-8 col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4 ms-3">
          <div>
            <h2 class="fw-bold mb-1">API Mock Posts Sandbox</h2>
            <p class="text-muted mb-0">Manage posts with full REST operations (GET, POST, PUT, DELETE)</p>
          </div>
          <!-- Loader indicator -->
          <div v-if="loader" class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <div v-if="response.length === 0" class="text-center py-5 my-4 bg-white rounded-4 border border-light shadow-sm">
          <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
          <h5>No posts loaded yet</h5>
          <p class="text-muted small">Create a new post using the form to get started!</p>
        </div>

        <div class="row g-3">
          <div 
            class="col-12 animate__animated animate__fadeInUp animate__faster" 
            v-for="(data, index) in response" 
            :key="index"
          >
            <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
              <div class="card-header bg-white border-0 d-flex justify-content-between align-items-start pt-3">
                <div class="pe-3">
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill mb-2">User ID: {{ data.userId }}</span>
                  <h4 class="fw-bold mb-0 text-dark">{{ data.title }}</h4>
                </div>
                <div class="d-flex gap-1">
                  <button class="btn btn-light btn-sm rounded-circle p-2" @click="edit(data, index)" title="Edit Post">
                    <i class="fas fa-pen text-primary"></i>
                  </button>
                  <button class="btn btn-light btn-sm rounded-circle p-2" @click="deleteRequest(data, index)" title="Delete Post">
                    <i class="fas fa-trash text-danger"></i>
                  </button>
                </div>
              </div>
              <div class="card-body pt-1 pb-3">
                <p class="card-text text-secondary mb-0">{{ data.body }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-success-subtle {
  background-color: #d1e7dd;
}
.sticky-md-top {
  z-index: 100;
}
</style>
