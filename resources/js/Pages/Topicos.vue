<template>
    <header-layout></header-layout>
    <div class="container py-12">
        <div>
            <h4>{{topicos.titulo}}              
            <inertia-link v-if="$page.props.user" class="btn btn-info" :href="route('items.edit', topicos.id)">
                    Reponder
             </inertia-link>
             </h4> 
             <ul v-for="comentario in comentarios" :key="comentario.id" class="list-group list-group-flush">
                <li class="list-group-item">{{comentario.comentario}}</li>
                <li class="list-group-item">teste</li>

             </ul>

        </div>
        <!-- <ul v-for="topico in topicos" :key="topico.id">
            <li></li>
        </ul> -->
    </div>
</template>
<script>
import HeaderLayout from "@/Layouts/HeaderLayout";

export default {
    components: {
        HeaderLayout
    },

    props: {
        topicos: Object,
        comentarios: Object
    }
}
</script>