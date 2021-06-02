<template>
     <comentario-layout>
         <template #form-comentario>
              <form @submit.prevent="store">
                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentário</label>
                    <textarea
                    v-model="form.comentario"
                    class="form-control"
                    rows="3"
                    required
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-dark">
                    Adicionar novo comentario
                </button>
            </form>
        </template>
     </comentario-layout>
</template>
<script>
import ComentarioLayout from "../../Layouts/ComentarioLayout";

export default {
  components: {
    ComentarioLayout
  },

  remember: "form",

  props: {
    params: Array
  },

  data() {
    return {
      form: this.$inertia.form({
        comentario: null,
      }),
    };
  },

  methods: {
    store() {
      this.form.post(this.route("items.store", this.params));
    }
  }
};
</script>