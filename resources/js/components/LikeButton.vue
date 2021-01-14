<template>
  <div class="row">
    <!-- agrega el like-active solo si la variable like es 1 que equivale a true -->
    <div class="col-md-12">
      <span
        v-on:click="giveLike"
        class="like-btn"
        :class="{ 'like-active': isActive }"
      ></span>
      <p>
        <strong>{{ showLikes }}</strong> Likes
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["recetaId", "like", "likes"],
  // los valore de data son lo que pueden mutar
  data() {
    return {
      totalLikes: this.likes,
      isActive: this.like,
    };
  },

  mounted() {
    console.log("loaded.");
  },

  methods: {
    giveLike(event) {
      // peticion to the backend
      axios
        .post(`/recetas/${this.recetaId}`)
        .then((res) => {
          if (res.data.attached.length > 0) {
            this.$data.totalLikes++;
          } else {
            this.$data.totalLikes--;
          }

          // retorna lo contrario al valor actual, si el valor actual es false retorna true
          this.isActive = !this.isActive;
        })
        .catch((error) => {
          if (error.response.status === 401) {
            // redirecionar porque no esta autenticado
            window.location = "/register";
          }
        });
    },
  },

  /* son iguales a los metodos solo que se cachean */
  computed: {
    showLikes() {
      return this.totalLikes;
    },
  },
};
</script>
