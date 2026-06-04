<script>
import { ref } from "vue";
export default {
  name: "ColorsPallet",

  setup() {
    const color = ref("rgb(13, 110, 253)");
    const hexColor = ref("#0d6efd");
    const copied = ref(false);

    const rgbToHex = (r, g, b) => {
      return "#" + [r, g, b].map(x => {
        const hex = x.toString(16);
        return hex.length === 1 ? "0" + hex : hex;
      }).join("");
    };

    const changeColor = () => {
      const r = Math.floor(Math.random() * 256);
      const g = Math.floor(Math.random() * 256);
      const b = Math.floor(Math.random() * 256);
      color.value = `rgb(${r}, ${g}, ${b})`;
      hexColor.value = rgbToHex(r, g, b);
    };

    const copyToClipboard = () => {
      navigator.clipboard.writeText(hexColor.value).then(() => {
        copied.value = true;
        setTimeout(() => {
          copied.value = false;
        }, 1500);
      }).catch(err => {
        console.error("Failed to copy color: ", err);
      });
    };

    return {
      color,
      hexColor,
      copied,
      changeColor,
      copyToClipboard,
    };
  },
};
</script>

<template>
  <div
    id="page"
    class="d-flex flex-column justify-content-center align-items-center transition-bg"
    :style="{
      width: '100%',
      minHeight: 'calc(100vh - 104px)',
      backgroundColor: color,
    }"
  >
    <div class="card p-4 shadow-lg text-center bg-white border-0 rounded-4" style="max-width: 400px; width: 90%;">
      <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2 rounded-pill">Vue 3 Core Concept</span>
      <h3 class="fw-bold mb-3">Composition API</h3>
      
      <div class="my-4">
        <!-- Display Color Code -->
        <div class="fs-4 fw-mono text-dark font-monospace mb-2">{{ hexColor.toUpperCase() }}</div>
        <div class="text-muted small mb-3">{{ color }}</div>
        
        <!-- Copy Button -->
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" @click="copyToClipboard">
          <i class="fas" :class="copied ? 'fa-check text-success' : 'fa-copy'"></i>
          <span class="ms-2">{{ copied ? 'Copied!' : 'Copy HEX' }}</span>
        </button>
      </div>

      <div class="d-grid gap-2">
        <button class="btn btn-primary btn-lg rounded-pill shadow-sm" @click="changeColor">
          <i class="fas fa-sync-alt me-2"></i>Generate Random Color
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.transition-bg {
  transition: background-color 0.5s ease-in-out;
}
.fw-mono {
  font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
}
.bg-primary-subtle {
  background-color: #e7f1ff;
}
</style>

