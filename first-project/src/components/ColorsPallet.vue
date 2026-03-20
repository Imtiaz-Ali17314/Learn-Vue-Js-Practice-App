<script>
import { ref } from "vue";
export default {
  name: "ColorsPallet",

  setup() {
    let color = ref("red");
    let i;
    let value = [];
    const chnageColor = () => {
      for (i = 0; i < 3; i++) {
        let random = Math.floor(Math.random() * 256);
        value.push(random);
      }
      color.value = "rgb(" + value + ")";
      value = [];
    };

    return {
      color,
      chnageColor,
      value,
    };
  },
};
</script>

<template>
  <div
    id="page"
    :style="{
      width: '100%',
      height: '1000vh',
      background: color,
    }"
  >
    <h1>Compositional Api in Vue Js</h1>
    <button class="btn btn-warning" @click="chnageColor">Change</button>
  </div>
</template>
