<script>
import axios from "axios";

export default {

  name: "FileUpload",
  data() {
    return {
      files: [],
      uploadedFiles: [],
    };
  },
  mounted() {
    this.fetchUploadedFiles();
  },
  methods: {
    handleFileUpload(event) {
      this.files = Array.from(event.target.files);
    },

    async submitFile() {
      try {
        // 1. Get CSRF cookie
        await axios.get("http://localhost:8000/sanctum/csrf-cookie", {
          withCredentials: true,
        });

        // 2. Now submit file
        const formData = new FormData();
        this.files.forEach(file => formData.append("files[]", file));

        const response = await axios.post("http://localhost:8000/api/user", formData, {
          headers: { "Content-Type": "multipart/form-data" },
          withCredentials: true,
          withXSRFToken: true,
        });

        alert("Files uploaded successfully!");
        console.log("Upload success", response.data);
        this.fetchUploadedFiles();
      } catch (error) {
        alert(" Error uploading files!");
        console.error("Error uploading files:", error);
      }
    },

    async fetchUploadedFiles() {
      const response = await axios.get("http://localhost:8000/api/get-all", {
        withCredentials: true,
      });
      // show already uploaded files last
      this.uploadedFiles = response.data;
    },

    async removeImage(index) {
      const file = this.uploadedFiles[index];
      try {
        // 1. Get CSRF cookie first
        await axios.get("http://localhost:8000/sanctum/csrf-cookie", {
          withCredentials: true,
        });

        // 2. Now send delete request with credentials
        await axios.delete(`http://localhost:8000/api/user/${file.id}`, {
          withCredentials: true,
          withXSRFToken: true,
        });
        this.uploadedFiles.splice(index, 1);
        alert('Image deleted successfully!');
      } catch (error) {
        console.error(error);
        alert('Failed to delete image');
      }
    }
  },
};
</script>

<template>
  <div class="container vh-100 d-flex flex-column py-4">
    <!-- Upper Half: File Upload -->
    <div class="flex-fill d-flex flex-column justify-content-center align-items-center border rounded p-4 mb-3">
      <h3>File Upload (Vue + Laravel)</h3>

      <!-- File input -->
      <input type="file" @change="handleFileUpload" multiple class="form-control my-3" />

      <!-- Submit button -->
      <button class="btn btn-primary" @click="submitFile">Upload</button>
    </div>

    <!-- Lower Half: Uploaded Images Grid -->
    <div class="flex-fill overflow-auto">
      <h4 class="mb-3">Uploaded Files</h4>
      <div class="d-flex flex-wrap gap-3">
        <div v-for="(file, index) in uploadedFiles" :key="index" class="image-card position-relative">

          <!-- Delete Badge -->
          <span class="delete-badge" @click="removeImage(index)">X</span>

          <img :src="`http://localhost:8000/storage/${file.file_name}`" alt="uploaded file">
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.flex-fill {
  flex: 1 1 50%;
}

.image-card {
  width: 300px;
  /* fixed width */
  height: 300px;
  /* fixed height */
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  flex-shrink: 0;
  /* scroll nahi chahiye */
}

.image-card img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  /* poora card fill ho jaye */
  display: block;
  transition: transform 0.3s;
}

.image-card img:hover {
  transform: scale(1.1);
  /* hover zoom effect */
}

/* Delete badge */
.delete-badge {
  position: absolute;
  top: 5px;
  right: 5px;
  background-color: rgba(255, 0, 0, 0.8);
  color: white;
  border-radius: 50%;
  width: 22px;
  height: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-weight: bold;
  z-index: 10;
  transition: background 0.2s;
}

.delete-badge:hover {
  background-color: rgba(255, 0, 0, 1);
}
</style>
