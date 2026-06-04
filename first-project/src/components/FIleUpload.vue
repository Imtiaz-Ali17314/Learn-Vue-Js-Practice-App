<script>
import axios from "axios";

export default {
  name: "FileUpload",
  data() {
    return {
      files: [],
      previews: [],
      uploadedFiles: [],
      isUploading: false,
      isFetching: false,
      fetchError: false,
      isDragging: false,
      alertMessage: "",
      alertType: "",
      showAlert: false,
    };
  },
  mounted() {
    this.fetchUploadedFiles();
  },
  methods: {
    handleFileUpload(event) {
      const selectedFiles = Array.from(event.target.files);
      this.addFiles(selectedFiles);
    },

    addFiles(fileList) {
      this.files = [...this.files, ...fileList];
      fileList.forEach((file) => {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.previews.push({
              name: file.name,
              size: (file.size / 1024).toFixed(1),
              url: e.target.result,
              type: "image",
            });
          };
          reader.readAsDataURL(file);
        } else {
          this.previews.push({
            name: file.name,
            size: (file.size / 1024).toFixed(1),
            url: null,
            type: file.type || "unknown",
          });
        }
      });
    },

    removePreview(index) {
      this.files.splice(index, 1);
      this.previews.splice(index, 1);
    },

    handleDragOver(event) {
      event.preventDefault();
      this.isDragging = true;
    },

    handleDragLeave() {
      this.isDragging = false;
    },

    handleDrop(event) {
      event.preventDefault();
      this.isDragging = false;
      const droppedFiles = Array.from(event.dataTransfer.files);
      this.addFiles(droppedFiles);
    },

    showAlertMessage(type, message) {
      this.alertType = type;
      this.alertMessage = message;
      this.showAlert = true;
      setTimeout(() => {
        this.showAlert = false;
      }, 4000);
    },

    async submitFile() {
      if (this.files.length === 0) {
        this.showAlertMessage("warning", "Please select files to upload.");
        return;
      }

      this.isUploading = true;
      try {
        await axios.get("http://localhost:8000/sanctum/csrf-cookie", {
          withCredentials: true,
        });

        const formData = new FormData();
        this.files.forEach((file) => formData.append("files[]", file));

        await axios.post("http://localhost:8000/api/user", formData, {
          headers: { "Content-Type": "multipart/form-data" },
          withCredentials: true,
          withXSRFToken: true,
        });

        this.showAlertMessage("success", "Files uploaded successfully!");
        this.files = [];
        this.previews = [];
        this.fetchUploadedFiles();
      } catch (error) {
        console.error("Error uploading files:", error);
        this.showAlertMessage(
          "danger",
          "Upload failed. Please check your connection and try again."
        );
      } finally {
        this.isUploading = false;
      }
    },

    async fetchUploadedFiles() {
      this.isFetching = true;
      this.fetchError = false;
      try {
        const response = await axios.get("http://localhost:8000/api/get-all", {
          withCredentials: true,
        });
        // Handle both direct array and Laravel resource/paginated format
        const data = response.data;
        if (Array.isArray(data)) {
          this.uploadedFiles = data;
        } else if (data && Array.isArray(data.data)) {
          this.uploadedFiles = data.data;
        } else {
          this.uploadedFiles = [];
        }
      } catch (error) {
        console.error("Error fetching files:", error);
        this.fetchError = true;
        this.uploadedFiles = [];
      } finally {
        this.isFetching = false;
      }
    },

    async removeImage(index) {
      const file = this.uploadedFiles[index];
      try {
        await axios.get("http://localhost:8000/sanctum/csrf-cookie", {
          withCredentials: true,
        });

        await axios.delete(`http://localhost:8000/api/user/${file.id}`, {
          withCredentials: true,
          withXSRFToken: true,
        });
        this.uploadedFiles.splice(index, 1);
        this.showAlertMessage("success", "Image deleted successfully!");
      } catch (error) {
        console.error(error);
        this.showAlertMessage("danger", "Failed to delete image.");
      }
    },

    getFileIcon(type) {
      if (type.includes("pdf")) return "fa-file-pdf";
      if (type.includes("word") || type.includes("document")) return "fa-file-word";
      if (type.includes("sheet") || type.includes("excel")) return "fa-file-excel";
      if (type.includes("zip") || type.includes("archive")) return "fa-file-archive";
      if (type.includes("video")) return "fa-file-video";
      if (type.includes("audio")) return "fa-file-audio";
      return "fa-file-alt";
    },
  },
};
</script>

<template>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">

        <!-- Page Header -->
        <div class="text-center mb-4">
          <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 64px; height: 64px;">
            <i class="fas fa-cloud-upload-alt fa-2x text-primary"></i>
          </div>
          <h2 class="fw-bold mb-1" style="color: #e8eaed;">File Upload</h2>
          <p class="text-muted mb-0">Vue + Laravel &middot; Drag & drop or browse files</p>
        </div>

        <!-- Alert Banner -->
        <transition name="fade">
          <div
            v-if="showAlert"
            class="alert alert-dismissible fade show shadow-sm mb-4"
            :class="`alert-${alertType}`"
            role="alert"
          >
            <i
              class="fas me-2"
              :class="{
                'fa-check-circle': alertType === 'success',
                'fa-exclamation-triangle': alertType === 'danger',
                'fa-info-circle': alertType === 'warning'
              }"
            ></i>
            {{ alertMessage }}
            <button type="button" class="btn-close" @click="showAlert = false" aria-label="Close"></button>
          </div>
        </transition>

        <!-- Upload Card -->
        <div class="card upload-card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">
          <div class="card-body p-4">

            <!-- Drag & Drop Zone -->
            <div
              class="drop-zone text-center p-5 rounded-3 mb-3"
              :class="{ 'drop-zone--active': isDragging }"
              @dragover="handleDragOver"
              @dragleave="handleDragLeave"
              @drop="handleDrop"
            >
              <div class="drop-zone__icon mb-3">
                <i class="fas fa-cloud-upload-alt fa-3x" :class="isDragging ? 'text-primary' : 'text-secondary'"></i>
              </div>
              <p class="mb-2 fw-semibold" style="color: #c9d1d9;">
                {{ isDragging ? 'Drop files here...' : 'Drag & drop files here' }}
              </p>
              <p class="text-muted small mb-3">or</p>
              <label class="btn btn-outline-primary btn-sm rounded-pill px-4">
                <i class="fas fa-folder-open me-2"></i>Browse Files
                <input
                  type="file"
                  @change="handleFileUpload"
                  multiple
                  class="d-none"
                />
              </label>
            </div>

            <!-- File Previews -->
            <div v-if="previews.length > 0" class="mb-3">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="fw-bold mb-0" style="color: #c9d1d9;">
                  <i class="fas fa-paperclip me-2 text-primary"></i>Selected Files
                  <span class="badge bg-primary bg-opacity-25 text-primary ms-2">{{ previews.length }}</span>
                </h6>
              </div>
              <div class="row g-3">
                <div v-for="(preview, index) in previews" :key="index" class="col-6 col-sm-4 col-md-3">
                  <div class="preview-card position-relative rounded-3 overflow-hidden">
                    <!-- Image preview -->
                    <img
                      v-if="preview.type === 'image'"
                      :src="preview.url"
                      :alt="preview.name"
                      class="preview-card__img"
                    />
                    <!-- Non-image file icon -->
                    <div v-else class="preview-card__icon d-flex flex-column align-items-center justify-content-center">
                      <i class="fas fa-2x text-secondary" :class="getFileIcon(preview.type)"></i>
                    </div>
                    <!-- Overlay info -->
                    <div class="preview-card__overlay">
                      <span class="small text-truncate d-block">{{ preview.name }}</span>
                      <span class="badge bg-dark bg-opacity-75 mt-1">{{ preview.size }} KB</span>
                    </div>
                    <!-- Remove button -->
                    <button class="preview-card__remove" @click="removePreview(index)" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Upload Button -->
            <button
              class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm mt-2"
              :disabled="isUploading || files.length === 0"
              @click="submitFile"
            >
              <span v-if="isUploading">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Uploading...
              </span>
              <span v-else>
                <i class="fas fa-upload me-2"></i>Upload {{ files.length > 0 ? `(${files.length} file${files.length > 1 ? 's' : ''})` : '' }}
              </span>
            </button>
          </div>
        </div>

        <!-- Uploaded Files Gallery -->
        <div class="card gallery-card border-0 shadow-lg rounded-4 overflow-hidden">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="fw-bold mb-0" style="color: #c9d1d9;">
                <i class="fas fa-images me-2 text-success"></i>Uploaded Gallery
              </h5>
              <span v-if="uploadedFiles.length" class="badge bg-success bg-opacity-25 text-success">
                {{ uploadedFiles.length }} file{{ uploadedFiles.length > 1 ? 's' : '' }}
              </span>
            </div>

            <!-- Loading State -->
            <div v-if="isFetching" class="text-center py-5">
              <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <p class="text-muted small">Loading uploaded files...</p>
            </div>

            <!-- Error State -->
            <div v-else-if="fetchError" class="text-center py-5">
              <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
              <p class="text-muted mb-1">Could not load uploaded files</p>
              <p class="text-muted small mb-3">Make sure the Laravel backend is running on <code>localhost:8000</code></p>
              <button class="btn btn-outline-primary btn-sm rounded-pill px-4" @click="fetchUploadedFiles">
                <i class="fas fa-redo me-2"></i>Retry
              </button>
            </div>

            <!-- Empty State -->
            <div v-else-if="uploadedFiles.length === 0" class="text-center py-5">
              <i class="fas fa-inbox fa-3x text-secondary mb-3"></i>
              <p class="text-muted mb-0">No files uploaded yet</p>
            </div>

            <!-- Gallery Grid -->
            <div v-else class="row g-3">
              <div
                v-for="(file, index) in uploadedFiles"
                :key="file.id || index"
                class="col-6 col-sm-4 col-md-3"
              >
                <div class="gallery-item position-relative rounded-3 overflow-hidden">
                  <img
                    :src="`http://localhost:8000/storage/${file.file_name}`"
                    alt="uploaded file"
                    class="gallery-item__img"
                  />
                  <div class="gallery-item__overlay">
                    <button class="btn btn-sm btn-danger rounded-circle shadow" @click="removeImage(index)" title="Delete">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
/* ── Upload Card ── */
.upload-card {
  background: linear-gradient(135deg, #1e2130 0%, #1a1d2e 100%);
}

.gallery-card {
  background: linear-gradient(135deg, #1a1d2e 0%, #1e2130 100%);
}

/* ── Drop Zone ── */
.drop-zone {
  border: 2px dashed #3a3f55;
  background: rgba(255, 255, 255, 0.02);
  transition: all 0.3s ease;
  cursor: pointer;
}

.drop-zone:hover {
  border-color: #4a7dff;
  background: rgba(74, 125, 255, 0.04);
}

.drop-zone--active {
  border-color: #4a7dff;
  background: rgba(74, 125, 255, 0.08);
  transform: scale(1.01);
}

.drop-zone__icon {
  transition: transform 0.3s ease;
}

.drop-zone--active .drop-zone__icon {
  transform: scale(1.15) translateY(-4px);
}

/* ── Preview Cards ── */
.preview-card {
  aspect-ratio: 1;
  background: #252839;
  border: 1px solid #3a3f55;
  transition: all 0.3s ease;
}

.preview-card:hover {
  border-color: #4a7dff;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(74, 125, 255, 0.15);
}

.preview-card__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.preview-card__icon {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #252839 0%, #2a2d42 100%);
}

.preview-card__overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 8px;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.85));
  color: #fff;
  font-size: 0.75rem;
}

.preview-card__remove {
  position: absolute;
  top: 6px;
  right: 6px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: none;
  background: rgba(255, 59, 48, 0.85);
  color: #fff;
  font-size: 0.65rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  opacity: 0;
  transition: all 0.2s ease;
  backdrop-filter: blur(4px);
}

.preview-card:hover .preview-card__remove {
  opacity: 1;
}

.preview-card__remove:hover {
  background: rgba(255, 59, 48, 1);
  transform: scale(1.15);
}

/* ── Gallery Items ── */
.gallery-item {
  aspect-ratio: 1;
  background: #252839;
  border: 1px solid #3a3f55;
  transition: all 0.3s ease;
}

.gallery-item:hover {
  border-color: #28a745;
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(40, 167, 69, 0.15);
}

.gallery-item__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}

.gallery-item:hover .gallery-item__img {
  transform: scale(1.08);
}

.gallery-item__overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  backdrop-filter: blur(2px);
}

.gallery-item:hover .gallery-item__overlay {
  opacity: 1;
}

/* ── Transitions ── */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease, transform 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
