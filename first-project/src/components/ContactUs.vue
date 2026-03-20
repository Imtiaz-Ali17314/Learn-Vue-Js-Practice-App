<script>
export default {
  name: "ContactUs",
  data() {
    return {
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
      let valid = true;
      for (let key in this.error) {
        if (this.error[key].state === null || this.error[key].state === true) {
          this.error[key].state = true;
          this.error[key].message = "Field not touched";
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
        console.log(formData);
      } else {
        alert();
      }
    },
    required(name, value) {
      this.error[name] = {
        state: !value,
        message: value ? "" : "This field is requireds",
      };
    },

    validateEmail(value) {
      if (!value) {
        this.error.email = {
          state: true,
          message: "This field is requireds",
        };
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        this.error.email = {
          state: true,
          message: "Invalid Email",
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
          message: "This field is requireds",
        };
      } else if (value.length < minLength) {
        this.error.mobile = {
          state: true,
          message: "Minimam " + minLength + " digits number",
        };
      } else if (value.length > maxLength) {
        this.error.mobile = {
          state: true,
          message: "Maximam " + maxLength + " digits number",
        };
      } else {
        this.error.mobile = {
          state: false,
          message: "",
        };
      }
    },

    removeError(e) {
      let input = e.target;
      let name = input.name;
      let checked = input.checked;

      this.error[name] = {
        state: checked ? false : true,
        message: checked ? "" : "Field not touched",
      };
    },
  },
};
</script>
<template>
  <div>
    <h1>Form with complete Validations</h1>
    <div class="container my-3 d-flex justify-content-left">
      <div
        class="p-4 rounded border shadow-sm bg-dark text-white"
        style="width: 400px"
      >
        <h3 class="mb-4 text-primary">Contact Us</h3>

        <form @submit.prevent="handleForm()">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Enter your name"
              v-model="form.fullname"
              @blur="required('fullname', form.fullname)"
              @input="required('fullname', form.fullname)"
              :style="
                error.fullname.state
                  ? 'border-color:red; outline-color:red'
                  : 'null'
              "
            />
            <p v-if="error.fullname.state" style="color: red">
              {{ error.fullname.message }}
            </p>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Enter your email"
              v-model="form.email"
              @blur="validateEmail(form.email)"
              @input="validateEmail(form.email)"
              :style="
                error.email.state
                  ? 'border-color:red; outline-color:red'
                  : 'null'
              "
            />
            <p v-if="error.email.state" style="color: red">
              {{ error.email.message }}
            </p>
          </div>

          <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input
              type="text"
              class="form-control"
              id="mobile"
              placeholder="03xx-xxxxxxx"
              v-model="form.mobile"
              @blur="validateMobile(form.mobile, 4, 11)"
              @input="validateMobile(form.mobile, 4, 11)"
              :style="
                error.mobile.state
                  ? 'border-color:red; outline-color:red'
                  : 'null'
              "
            />
            <p v-if="error.mobile.state" style="color: red">
              {{ error.mobile.message }}
            </p>
          </div>

          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select
              class="form-select"
              id="gender"
              @change="required('gender', form.gender)"
              v-model="form.gender"
            >
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <p v-if="error.gender.state" style="color: red">
              {{ error.gender.message }}
            </p>
          </div>

          <div class="mb-3">
            <label for="degree" class="form-label">Your Degree</label>
            <input
              name="degree"
              type="radio"
              class="form-radio"
              id="degree"
              v-model="form.degree"
              value="FA"
              @change="removeError($event)"
            />FA
            <input
              name="degree"
              type="radio"
              class="form-radio"
              id="degree"
              v-model="form.degree"
              value="BA"
              @change="removeError($event)"
            />BA
            <input
              name="degree"
              type="radio"
              class="form-radio"
              id="degree"
              v-model="form.degree"
              value="MA"
              @change="removeError($event)"
            />MA
            <p v-if="error.degree.state" style="color: red">
              {{ error.degree.message }}
            </p>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Your Message</label>
            <textarea
              class="form-control"
              id="message"
              rows="4"
              placeholder="Type your message here..."
              v-model="form.message"
              @blur="required('message', form.message)"
              @input="required('message', form.message)"
              :style="
                error.message.state
                  ? 'border-color:red; outline-color:red'
                  : 'null'
              "
            >
            </textarea>
            <p v-if="error.message.state" style="color: red">
              {{ error.message.message }}
            </p>
          </div>

          <div class="mb-3">
            <input
              name="accept"
              type="checkbox"
              class="form-checkbox"
              id="accept"
              v-model="form.accept"
              @change="removeError($event)"
            />I accept
            <p v-if="error.accept.state" style="color: red">
              {{ error.accept.message }}
            </p>
          </div>

          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
