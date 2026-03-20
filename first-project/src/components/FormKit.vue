<script>
export default {
  name: "formKit",

  data() {
    return {
      options: {
        "": "",
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
      let striing = JSON.stringify(this.formData);
      let data = JSON.parse(striing);

      console.log(data);
    },
  },
};
</script>

<template>
  <div>
    <h1 class="ms-3">Create From using FormKit package with full Vlidations</h1>
    <div class="ms-5 mt-3 p-4 rounded border shadow-lg w-25 bg-light">
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
          label="FullName"
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
          help="Enter your Password"
          validation="required|length:8|matches:/[^a-zA-Z]/"
        />

        <FormKit
          type="password"
          name="confirm_password"
          placeholder="*******"
          label="Confirm Password"
          help="ReEnter your Password"
          validation="required"
        />

        <FormKit
          type="number"
          name="mobile"
          placeholder="03XX xxxxxxx"
          label="Mobile no"
          help="Enter your Mobile number"
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
          label="I accept"
          validation="required"
        />
      </FormKit>
    </div>
  </div>
</template>
