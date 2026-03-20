<script>
export default {
  name: "NavBar",
};
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <router-link class="navbar-brand text-success" to="/"
        >Learning Vue App</router-link
      >

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link active" to="/home">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/contact">Contact Us</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/post">Post</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/formkit">FormKit</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/colors">ColorsPallet</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/upload">FileUpload</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>
