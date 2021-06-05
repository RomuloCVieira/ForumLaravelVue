<template>
  <app-layout>  </app-layout>

    <div class="py-12">
      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <!-- <inertia-link
          v-if="$page.props.user"
          href="/forum"
          class="text-sm text-gray-700 underline"
        >
          Dashboard
        </inertia-link>

        <template v-else>
          <inertia-link
            :href="route('login')"
            class="text-sm text-gray-700 underline"
          >
            Log in
          </inertia-link>

          <inertia-link
            :href="route('register')"
            class="ml-4 text-sm text-gray-700 underline"
          >
            Register
          </inertia-link>
        </template> -->
      </div>
      <div class="container">
        <div class="text-right">
          <a href="/forum/create" class="btn btn-dark">Adicionar</a>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Titulo</th>
              <th scope="col">Mensagem</th>
              <th scope="col">Data de Criação</th>
              <th scope="col">Autor</th>
              <th scope="col">#</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="topico in topicos" :key="topico.id">
              <th scope="row">{{ topico.id }}</th>
              <td>{{ topico.titulo }}</td>
              <td>{{ topico.mensagem }}</td>
              <td>{{ format_date(topico.created_at) }}</td>
              <td>{{ topico.name }}</td>
              <td>
                <div class="text-right">
                    <button v-if="$page.props.user"
                      type="submit"
                      @click="destroy(topico.id)"
                      class="btn btn-danger mr-2"
                    >
                      Remover
                    </button>
                    <inertia-link v-if="$page.props.user"
                      class="btn btn-success mr-2"
                      :href="route('forum.edit', topico)"
                    >
                      Editar
                    </inertia-link>
                    <inertia-link
                      class="btn btn-info"
                      :href="route('forum.show', topico.id)"
                    >
                      Visualizar
                    </inertia-link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import HeaderLayout from "@/Layouts/HeaderLayout";

import Welcome from "@/Jetstream/Welcome";
import moment from "moment";

export default {
  components: {
    AppLayout,
    Welcome,
    HeaderLayout,
  },
  props: {
    topicos: Object,
  },
  methods: {
    format_date(value) {
      if (value) {
        return moment(String(value)).format("D/M/Y");
      }
    },
    destroy(value) {
      if (confirm("Tem certeza de que deseja excluir este forum?")) {
        this.$inertia.delete(this.route("forum.destroy", value));
      }
    }
  }
};
</script>
