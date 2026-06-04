<script>
export default {
  name: "NavBar",
};
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <router-link class="navbar-brand text-success fw-bold" to="/">
        <i class="fab fa-vuejs me-2"></i>Vue Learning Hub
      </router-link>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarContent"
        aria-controls="navbarContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/home">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/contact">Contact Us</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/post">Post</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/formkit">FormKit</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/colors">ColorsPallet</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="/upload">FileUpload</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

