<template>
  <input
    type="submit"
    class="btn btn-danger mr-1"
    value="Delete ×"
    @click="eliminarReceta"
  />
</template>

<script>
export default {
  props: ["recetaId"],
  methods: {
    eliminarReceta() {
      /* alert */
      this.$swal({
        title: "Deseas eliminar la receta?",
        text: "Una vez eliminada, no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
          const params = {
            id: this.recetaId,
          };

          // send request to the server
          axios
            .post(`/recetas/${this.recetaId}`, {
              params,
              _method: "delete",
            })
            .then((respuesta) => {
              // show alert
              this.$swal({
                title: "Receta Eliminada",
                text: "Se elimino la receta",
                icon: "success",
              });

              // delete item of the DOM, $el: elemento que lo contiene
              this.$el.parentElement.parentElement.parentElement.parentElement.removeChild(
                this.$el.parentElement.parentElement.parentElement
              );
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
  },
};
</script>
