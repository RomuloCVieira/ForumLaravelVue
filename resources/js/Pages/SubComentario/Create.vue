<template>
  <form-layout>
    <template #formlayout>
        <form @submit.prevent="store">
          <div class="mb-3">
            <label for="comentario" class="form-label">Comentário</label>
            <textarea
              v-model="form.comentario"
              class="form-control"
              rows="3"
            ></textarea>

            {{idcomentario}}
                        {{forum}}
          </div>
          <button type="submit" class="btn btn-dark">
            Adicionar novo comentario
          </button>
        </form>
    </template>
  </form-layout>
</template>
<script>
import FormLayout from "../Forum/FormLayout";

export default {
  components: {
    FormLayout,
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
      this.form.post(this.route("subs.store", this.params));
    }
  }
};
</script>