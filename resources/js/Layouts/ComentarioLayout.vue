<template>
  <form-layout>
    <template #formlayout>
          <slot name='form-comentario'></slot>
    </template>
  </form-layout>
</template>        
<script>
import FormLayout from "../Pages/Forum/FormLayout";

export default {
  components: {
    FormLayout
  }
}
</script>