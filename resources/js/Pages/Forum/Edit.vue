<template>
  <form-layout>
    <template #formlayout>
      <form @submit.prevent="update">
        <div class="mb-3">
          <label class="form-label">Titulo</label>
          <input
            type="text"
            v-model="form.titulo"
            @submit.prevent="store"
            class="form-control"
            placeholder="Fulano"
          />
        </div>
        <div class="mb-3">
          <label for="mensagem" class="form-label">Mensagem</label>
          <textarea
            v-model="form.mensagem"
            class="form-control"
            rows="3"
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

  props: {
    forum: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        titulo: this.forum.titulo,
        mensagem: this.forum.mensagem,
      }),
    };
  },

  methods: {
    update() {
      this.form.put(this.route("forum.update", this.forum));
    },
  },
};
</script>
