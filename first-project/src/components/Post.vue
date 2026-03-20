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
        this.response.push(response.data);
        this.loader = false;
      } catch (err) {
        this.loader = false;
        alert("Something is not write");
      }
    },

    async deleteRequest(data, index) {
      this.loader = true;
      let string = JSON.stringify(data);
      let deleteData = JSON.parse(string);
      let id = deleteData.id;
      try {
        await axios({
          method: "delete",
          url: "https://jsonplaceholder.typicode.com/posts/" + id,
        });
        this.loader = false;
        this.response.splice(index, 1);
      } catch (err) {
        console.log(err);
      }
    },

    edit(data, index) {
      console.log(data);
      this.save = true;
      let string = JSON.stringify(data);
      let editData = JSON.parse(string);

      this.userId = editData.userId;
      this.title = editData.title;
      this.body = editData.body;
      this.id = editData.id;
      this.cardIndex = index;
    },

    reset() {
      this.userId = "";
      this.title = "";
      this.body = "";
      this.save = false;
    },

    async updateData() {
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
        this.loader = false;
        this.response[this.cardIndex] = response.data;
      } catch (err) {
        console.log(err.response);
      }
    },
  },
};
</script>

<template>
  <div class="bg-light min-vh-100 container-fluid">
    <div class="row">
      <div class="col-md-3 bg-dark min-vh-100">
        <h3 class="text-white my-4">Vue Js Post Request</h3>
        <form @submit.prevent="save ? updateData() : postData()">
          <input
            type="number"
            placeholder="User Id"
            class="form-control mb-4"
            v-model="userId"
          />
          <input
            type="text"
            placeholder="Post Tilte"
            class="form-control mb-4"
            v-model="title"
          />
          <textarea
            placeholder="Post Body"
            class="form-control mb-4"
            v-model="body"
          ></textarea>

          <button type="submit" class="btn btn-success" v-if="!save">
            Create
          </button>
          <button type="submit" class="btn btn-danger me-3" v-if="save">
            Save
          </button>
          <button
            type="button"
            class="btn btn-warning"
            v-if="save"
            @click="reset"
          >
            Reset
          </button>
        </form>
      </div>
      <div class="col-md-9">
        <h2 class="ms-3">Create, Update and Delete data from Api</h2>
        <div
          class="card shadow-sm mb-4 animate__animated animate__shakeY animate__faster"
          v-for="(data, index) in response"
          :key="index"
        >
          <div class="card-header d-flex justify-content-between">
            <h3>{{ data.title }}</h3>
            <div class="d-flex align-items-center">
              <button class="btn" @click="edit(data, index)">
                <i class="fas fa-edit text-primary"></i>
              </button>
              <button class="btn" @click="deleteRequest(data, index)">
                <i class="fas fa-trash text-danger"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <p>{{ data.body }}</p>
          </div>
        </div>
        <i v-if="loader" class="fas fa-spinner fa-spin fa-2x text-primary"></i>
      </div>
    </div>
  </div>
</template>
