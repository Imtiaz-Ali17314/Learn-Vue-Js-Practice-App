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
        this.loader = false;
        this.response = ajax.data;
      } catch (err) {
        console.log(err.response);
      }
    },
  },
};
</script>

<template>
  <div>
    <h2 class="ms-3">Get data from Api using POST method</h2>
    <button class="btn btn-success ms-3" @click="fetchData()">Get data</button>
    <div
      class="card shadow-sm m-3 bg-light"
      v-for="(data, index) in response"
      :key="index"
    >
      <h1>ID : {{ data.id }}</h1>
      <h1>Title : {{ data.title }}</h1>
      <h3>Body : {{ data.body }}</h3>
    </div>
    <i v-if="loader" class="fas fa-spinner fa-spin fa-2x text-primary"></i>
  </div>
</template>
