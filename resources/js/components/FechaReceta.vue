<template>
  <!-- <span v-text="formatearFecha"></span> -->
  <span>{{ formatearFecha }}</span>
</template>

<script>
export default {
  props: ["fecha"],
  // mounted() {
  //   console.log('The date is', this.fecha);
  // },
  computed: {
    formatearFecha() {
      console.log(this.fecha);
      return moment(this.fecha).locale("es").format("DD [de] MMMM [del] YYYY");
    },
  },
};
</script>