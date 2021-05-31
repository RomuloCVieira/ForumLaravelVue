<template>
  <app-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                  <!-- <td>{{topico.name}}</td> -->
                  <td>
                    <div class="text-right">
                      <button
                        type="submit"
                        @click="destroy(topico.id)"
                        class="btn btn-danger mr-2"
                      >
                        Remover
                      </button>
                      <inertia-link class="btn btn-info" :href="route('forum.edit', topico)">
                        Editar
                      </inertia-link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import moment from "moment";

export default {
  components: {
    AppLayout,
    Welcome,
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
    },
  },
};
</script>
