<script>
export default {
  name: "ContactUs",
  data() {
    return {
      submitSuccess: false,
      submitError: false,
      form: {
        fullname: "",
        email: "",
        mobile: "",
        message: "",
        gender: "",
        degree: "",
        accept: false,
      },
      error: {
        fullname: {
          state: null,
          message: "",
        },
        email: {
          state: null,
          message: "",
        },
        mobile: {
          state: null,
          message: "",
        },
        gender: {
          state: null,
          message: "",
        },
        degree: {
          state: null,
          message: "",
        },
        accept: {
          state: null,
          message: "",
        },
        message: {
          state: null,
          message: "",
        },
      },
    };
  },

  methods: {
    validateOnSubmit() {
      // Run validation on all fields
      this.required("fullname", this.form.fullname);
      this.validateEmail(this.form.email);
      this.validateMobile(this.form.mobile, 4, 11);
      this.required("gender", this.form.gender);
      this.requiredRadio("degree", this.form.degree);
      this.required("message", this.form.message);
      this.requiredCheckbox("accept", this.form.accept);

      // Check if any error states are true
      let valid = true;
      for (let key in this.error) {
        if (this.error[key].state === true) {
          valid = false;
        }
      }
      return valid;
    },

    handleForm() {
      let isValid = this.validateOnSubmit();

      if (isValid) {
        let string = JSON.stringify(this.form);
        let formData = JSON.parse(string);
        console.log("Form Data Submitted:", formData);
        
        this.submitSuccess = true;
        this.submitError = false;
        
        // Reset form inputs
        this.form = {
          fullname: "",
          email: "",
          mobile: "",
          message: "",
          gender: "",
          degree: "",
          accept: false,
        };

        // Reset validation states
        for (let key in this.error) {
          this.error[key] = {
            state: null,
            message: "",
          };
        }
      } else {
        this.submitSuccess = false;
        this.submitError = true;
      }
    },

    required(name, value) {
      this.error[name] = {
        state: !value,
        message: value ? "" : "This field is required",
      };
    },

    requiredRadio(name, value) {
      this.error[name] = {
        state: !value,
        message: value ? "" : "Please select your degree",
      };
    },

    requiredCheckbox(name, value) {
      this.error[name] = {
        state: !value,
        message: value ? "" : "You must accept the terms",
      };
    },

    validateEmail(value) {
      if (!value) {
        this.error.email = {
          state: true,
          message: "This field is required",
        };
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        this.error.email = {
          state: true,
          message: "Invalid Email address",
        };
      } else {
        this.error.email = {
          state: false,
          message: "",
        };
      }
    },

    validateMobile(value, minLength, maxLength) {
      if (!value) {
        this.error.mobile = {
          state: true,
          message: "This field is required",
        };
      } else if (value.length < minLength) {
        this.error.mobile = {
          state: true,
          message: "Minimum " + minLength + " digits required",
        };
      } else if (value.length > maxLength) {
        this.error.mobile = {
          state: true,
          message: "Maximum " + maxLength + " digits allowed",
        };
      } else {
        this.error.mobile = {
          state: false,
          message: "",
        };
      }
    },
  },
};
</script>

<template>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        
        <!-- Success Alert -->
        <div v-if="submitSuccess" class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <strong>Success!</strong> Your message has been sent successfully.
          <button type="button" class="btn-close" @click="submitSuccess = false" aria-label="Close"></button>
        </div>

        <!-- Error Alert -->
        <div v-if="submitError" class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <strong>Error!</strong> Please fill in all fields correctly.
          <button type="button" class="btn-close" @click="submitError = false" aria-label="Close"></button>
        </div>

        <!-- Form Card -->
        <div class="card p-4 rounded-4 border-0 shadow-lg bg-dark text-white">
          <div class="d-flex align-items-center mb-4">
            <div class="bg-primary text-white rounded-circle p-2 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
              <i class="fas fa-envelope fa-lg"></i>
            </div>
            <div>
              <h3 class="mb-0 text-success fw-bold">Contact Us</h3>
              <p class="text-muted small mb-0">Custom client-side form validation</p>
            </div>
          </div>

          <form @submit.prevent="handleForm()">
            <!-- Full Name -->
            <div class="mb-3">
              <label for="name" class="form-label text-light">Full Name</label>
              <input
                type="text"
                class="form-control bg-secondary-subtle text-dark border-0"
                :class="{
                  'is-invalid': error.fullname.state === true,
                  'is-valid': error.fullname.state === false
                }"
                id="name"
                placeholder="Enter your name"
                v-model="form.fullname"
                @blur="required('fullname', form.fullname)"
                @input="required('fullname', form.fullname)"
              />
              <div class="invalid-feedback text-danger-emphasis fw-semibold">
                {{ error.fullname.message }}
              </div>
            </div>

            <!-- Email Address -->
            <div class="mb-3">
              <label for="email" class="form-label text-light">Email Address</label>
              <input
                type="email"
                class="form-control bg-secondary-subtle text-dark border-0"
                :class="{
                  'is-invalid': error.email.state === true,
                  'is-valid': error.email.state === false
                }"
                id="email"
                placeholder="Enter your email"
                v-model="form.email"
                @blur="validateEmail(form.email)"
                @input="validateEmail(form.email)"
              />
              <div class="invalid-feedback text-danger-emphasis fw-semibold">
                {{ error.email.message }}
              </div>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
              <label for="mobile" class="form-label text-light">Mobile Number</label>
              <input
                type="text"
                class="form-control bg-secondary-subtle text-dark border-0"
                :class="{
                  'is-invalid': error.mobile.state === true,
                  'is-valid': error.mobile.state === false
                }"
                id="mobile"
                placeholder="03xx-xxxxxxx"
                v-model="form.mobile"
                @blur="validateMobile(form.mobile, 4, 11)"
                @input="validateMobile(form.mobile, 4, 11)"
              />
              <div class="invalid-feedback text-danger-emphasis fw-semibold">
                {{ error.mobile.message }}
              </div>
            </div>

            <!-- Gender -->
            <div class="mb-3">
              <label for="gender" class="form-label text-light">Gender</label>
              <select
                class="form-select bg-secondary-subtle text-dark border-0"
                :class="{
                  'is-invalid': error.gender.state === true,
                  'is-valid': error.gender.state === false
                }"
                id="gender"
                @change="required('gender', form.gender)"
                v-model="form.gender"
              >
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <div class="invalid-feedback text-danger-emphasis fw-semibold">
                {{ error.gender.message }}
              </div>
            </div>

            <!-- Degree -->
            <div class="mb-3">
              <label class="form-label text-light d-block">Your Degree</label>
              <div class="d-flex gap-4 p-2 bg-secondary bg-opacity-25 rounded">
                <div class="form-check">
                  <input
                    name="degree"
                    type="radio"
                    class="form-check-input"
                    :class="{ 'is-invalid': error.degree.state === true }"
                    id="degree-fa"
                    v-model="form.degree"
                    value="FA"
                    @change="requiredRadio('degree', form.degree)"
                  />
                  <label class="form-check-label cursor-pointer" for="degree-fa">FA</label>
                </div>
                <div class="form-check">
                  <input
                    name="degree"
                    type="radio"
                    class="form-check-input"
                    :class="{ 'is-invalid': error.degree.state === true }"
                    id="degree-ba"
                    v-model="form.degree"
                    value="BA"
                    @change="requiredRadio('degree', form.degree)"
                  />
                  <label class="form-check-label cursor-pointer" for="degree-ba">BA</label>
                </div>
                <div class="form-check">
                  <input
                    name="degree"
                    type="radio"
                    class="form-check-input"
                    :class="{ 'is-invalid': error.degree.state === true }"
                    id="degree-ma"
                    v-model="form.degree"
                    value="MA"
                    @change="requiredRadio('degree', form.degree)"
                  />
                  <label class="form-check-label cursor-pointer" for="degree-ma">MA</label>
                </div>
              </div>
              <div v-if="error.degree.state" class="text-danger small mt-1 fw-semibold">
                {{ error.degree.message }}
              </div>
            </div>

            <!-- Message -->
            <div class="mb-3">
              <label for="message" class="form-label text-light">Your Message</label>
              <textarea
                class="form-control bg-secondary-subtle text-dark border-0"
                :class="{
                  'is-invalid': error.message.state === true,
                  'is-valid': error.message.state === false
                }"
                id="message"
                rows="4"
                placeholder="Type your message here..."
                v-model="form.message"
                @blur="required('message', form.message)"
                @input="required('message', form.message)"
              ></textarea>
              <div class="invalid-feedback text-danger-emphasis fw-semibold">
                {{ error.message.message }}
              </div>
            </div>

            <!-- Accept Checkbox -->
            <div class="mb-4">
              <div class="form-check">
                <input
                  name="accept"
                  type="checkbox"
                  class="form-check-input"
                  :class="{ 'is-invalid': error.accept.state === true }"
                  id="accept"
                  v-model="form.accept"
                  @change="requiredCheckbox('accept', form.accept)"
                />
                <label class="form-check-label cursor-pointer text-light small" for="accept">
                  I accept the terms and conditions
                </label>
                <div class="invalid-feedback text-danger-emphasis fw-semibold">
                  {{ error.accept.message }}
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill shadow">
              <i class="fas fa-paper-plane me-2"></i>Send Message
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
.bg-secondary-subtle {
  background-color: #e9ecef !important;
}

/* Force Bootstrap invalid-feedback to display when sibling has is-invalid */
.is-invalid ~ .invalid-feedback,
.is-invalid ~ .invalid-tooltip {
  display: block !important;
}

/* Ensure error text is bright and readable on dark card */
.invalid-feedback {
  color: #ff6b6b !important;
  font-weight: 600;
  font-size: 0.85rem;
  margin-top: 0.35rem;
}

/* Valid state green checkmark styling */
.is-valid {
  border-color: #198754 !important;
  box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15) !important;
}

/* Invalid state red border styling */
.is-invalid {
  border-color: #ff6b6b !important;
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.15) !important;
}

/* Degree / checkbox error text (manually shown via v-if) */
.text-danger {
  color: #ff6b6b !important;
}
</style>
