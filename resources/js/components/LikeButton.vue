<template>
  <div>
    <span v-on:click="animate" class="like-btn"></span>
  </div>
</template>

<script>
export default {
  props: [],
  mounted() {
    console.log("loading...");
  },

  methods: {
    animate(event) {
      event.target.classList.toggle("like-active");
    },
  },
};
</script>