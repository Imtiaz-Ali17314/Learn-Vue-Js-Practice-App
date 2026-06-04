<script>
import NavBar from "./components/NavBar.vue";

export default {
  name: "App",
  components: {
    NavBar,
  },
  watch: {
    $route(to) {
      document.title = to.meta.title || "Vue Learning Hub";
    },
  },
};
</script>

<style>
#router-view {
  overflow-x: hidden;
  padding: 24px 0;
  min-height: calc(100vh - 56px);
  background-color: #f8f9fa;
}

.effect-enter-active,
.effect-leave-active {
  transition: 0.3s ease;
}

.effect-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

.effect-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}
</style>

<template>
  <NavBar />

  <div id="router-view">
    <router-view v-slot="{ Component, route }">
      <transition name="effect" mode="out-in">
        <component :is="Component" :key="route.fullPath"></component>
      </transition>
    </router-view>
  </div>
</template>

