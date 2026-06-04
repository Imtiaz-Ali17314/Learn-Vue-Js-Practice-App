<script>
export default {
  name: "FormKitSandbox",

  data() {
    return {
      submitSuccess: false,
      submittedData: null,
      options: {
        "": "Select Gender",
        male: "Male",
        female: "Female",
      },

      subject: {
        science: "Science",
        arts: "Arts",
      },

      formData: {},
    };
  },

  methods: {
    onSubmit() {
      const formDataString = JSON.stringify(this.formData);
      this.submittedData = JSON.parse(formDataString);
      console.log("FormKit data submitted:", this.submittedData);
      this.submitSuccess = true;
    },
  },
};
</script>

<template>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        
        <!-- Heading -->
        <div class="text-center mb-4">
          <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3" style="width: 64px; height: 64px;">
            <i class="fas fa-shield-alt fa-2x text-success"></i>
          </div>
          <h2 class="fw-bold mb-1" style="color: #e8eaed;">Form Validation Sandbox</h2>
          <p class="text-muted mb-0">Built using FormKit validation rules &amp; Genesis theme</p>
        </div>

        <!-- Success Alert -->
        <div v-if="submitSuccess" class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <strong>Success!</strong> Registration completed. Check console or JSON output below.
          <button type="button" class="btn-close" @click="submitSuccess = false" aria-label="Close"></button>
        </div>

        <!-- FormKit Card -->
        <div class="formkit-wrapper p-4 rounded-4 shadow-lg mb-4">
          <FormKit
            type="form"
            submit-label="Register"
            v-model="formData"
            @submit="onSubmit"
          >
            <FormKit
              type="text"
              name="fullname"
              placeholder="Imtiaz Ali"
              label="Full Name"
              help="Enter your Name"
              validation="required"
            />

            <FormKit
              type="text"
              name="email"
              placeholder="abc@gmail.com"
              label="Email"
              help="Enter your Email"
              validation="required|email"
            />

            <FormKit
              type="password"
              name="password"
              placeholder="*******"
              label="Password"
              help="Minimum 8 characters, at least one number"
              validation="required|length:8|matches:/[^a-zA-Z]/"
            />

            <FormKit
              type="password"
              name="confirm_password"
              placeholder="Confirm Password"
              label="Confirm Password"
              help="Re-enter your password to confirm"
              validation="required|confirm:password"
              validation-label="Password confirmation"
            />

            <FormKit
              type="number"
              name="mobile"
              placeholder="03XX xxxxxxx"
              label="Mobile no"
              help="Enter your Mobile number (Minimum 4 digits)"
              validation="required|length:4"
            />

            <FormKit
              type="select"
              name="gender"
              label="Gender"
              :options="options"
              validation="required"
            />

            <FormKit
              type="radio"
              name="subject"
              label="Select Subject"
              :options="subject"
              validation="required"
            />

            <FormKit
              type="checkbox"
              name="accept"
              label="I accept the terms and conditions"
              validation="required"
            />
          </FormKit>
        </div>

        <!-- Submitted Data Output Panel -->
        <div v-if="submittedData" class="card p-3 rounded-3 border-0 bg-dark text-white shadow">
          <h5 class="text-success fw-bold mb-2">
            <i class="fas fa-code me-2"></i>Submitted JSON Output
          </h5>
          <pre class="mb-0 bg-secondary bg-opacity-25 p-3 rounded text-success font-monospace" style="font-size: 0.85rem;">{{ JSON.stringify(submittedData, null, 2) }}</pre>
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
/* ── FormKit Wrapper ── */
.formkit-wrapper {
  background: #ffffff;
  border: 1px solid #e2e8f0;
}

/* ── Override FormKit Genesis theme for clean rendering ── */
.formkit-wrapper :deep(.formkit-form) {
  font-family: inherit;
}

.formkit-wrapper :deep(.formkit-outer) {
  margin-bottom: 1rem;
}

.formkit-wrapper :deep(.formkit-label) {
  display: block;
  margin-bottom: 0.35rem;
  font-weight: 600;
  font-size: 0.9rem;
  color: #374151;
}

.formkit-wrapper :deep(.formkit-input) {
  width: 100%;
  padding: 0.55rem 0.85rem;
  border: 1.5px solid #d1d5db;
  border-radius: 0.5rem;
  font-size: 0.9rem;
  color: #1f2937;
  background: #f9fafb;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
  outline: none;
  box-sizing: border-box;
}

.formkit-wrapper :deep(.formkit-input:focus) {
  border-color: #4a7dff;
  box-shadow: 0 0 0 3px rgba(74, 125, 255, 0.15);
  background: #fff;
}

.formkit-wrapper :deep(.formkit-input[type="checkbox"]),
.formkit-wrapper :deep(.formkit-input[type="radio"]) {
  width: auto;
  padding: 0;
  margin-right: 0.4rem;
  accent-color: #198754;
}

.formkit-wrapper :deep(.formkit-help) {
  font-size: 0.78rem;
  color: #6b7280;
  margin-top: 0.25rem;
}

.formkit-wrapper :deep(.formkit-message) {
  font-size: 0.8rem;
  color: #dc3545;
  font-weight: 500;
  margin-top: 0.25rem;
}

.formkit-wrapper :deep(.formkit-messages) {
  list-style: none;
  padding: 0;
  margin: 0.25rem 0 0 0;
}

/* Select dropdown */
.formkit-wrapper :deep(.formkit-input[type="select"]),
.formkit-wrapper :deep(select.formkit-input) {
  appearance: auto;
  cursor: pointer;
}

/* Submit button from FormKit */
.formkit-wrapper :deep(.formkit-input[type="submit"]),
.formkit-wrapper :deep(button.formkit-input) {
  background: linear-gradient(135deg, #198754, #20c997);
  color: #fff;
  font-weight: 600;
  font-size: 1rem;
  padding: 0.65rem 1.5rem;
  border: none;
  border-radius: 2rem;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 100%;
  margin-top: 0.5rem;
  box-shadow: 0 4px 14px rgba(25, 135, 84, 0.3);
}

.formkit-wrapper :deep(.formkit-input[type="submit"]:hover),
.formkit-wrapper :deep(button.formkit-input:hover) {
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
}

/* Radio & checkbox groups */
.formkit-wrapper :deep(.formkit-options) {
  list-style: none;
  padding: 0;
  margin: 0;
}

.formkit-wrapper :deep(.formkit-option) {
  display: flex;
  align-items: center;
  padding: 0.3rem 0;
}

.formkit-wrapper :deep(.formkit-option label) {
  cursor: pointer;
  font-weight: 400;
  color: #374151;
}

/* Fieldset / legend cleanup */
.formkit-wrapper :deep(.formkit-fieldset) {
  border: none;
  padding: 0;
  margin: 0;
}

.formkit-wrapper :deep(.formkit-legend) {
  font-weight: 600;
  font-size: 0.9rem;
  color: #374151;
  margin-bottom: 0.35rem;
}

/* Error state styling on inputs */
.formkit-wrapper :deep(.formkit-outer[data-invalid] .formkit-input) {
  border-color: #dc3545;
  box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.12);
}

/* Actions wrapper (submit button container) */
.formkit-wrapper :deep(.formkit-actions) {
  margin-top: 0.5rem;
}

pre {
  overflow-x: auto;
}
</style>
