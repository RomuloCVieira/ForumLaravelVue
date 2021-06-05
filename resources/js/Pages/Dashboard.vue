<template>
  <app-layout>
    
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
  }
};
</script>
