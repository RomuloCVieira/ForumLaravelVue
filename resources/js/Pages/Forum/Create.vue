<template>
  <form-layout>
    <template #formlayout>
      <form @submit.prevent="store">
        <div class="mb-3">
          <label class="form-label">Titulo</label>
          <input
            type="text"
            v-model="form.titulo"
            @submit.prevent="store"
            class="form-control"
            placeholder="Fulano"
            required
          />
        </div>
        <div class="mb-3">
          <label for="mensagem" class="form-label">Mensagem</label>
          <textarea
            v-model="form.mensagem"
            class="form-control"
            rows="3"
            required
          ></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Criar Tópico</button>
      </form>
    </template>
  </form-layout>
</template>
<script>
import FormLayout from "./FormLayout";

export default {
  components: {
    FormLayout,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        titulo: null,
        mensagem: null
        }),
    };
  },
  methods: {
    store() {
      this.form.post(this.route("forum.store"));
    },
  },
};
</script>
