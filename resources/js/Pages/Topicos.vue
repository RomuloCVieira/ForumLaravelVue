<template>
    <app-layout>
    <div class="container py-12">
        <div>
            <h4>{{topicos.titulo}}              
            <inertia-link v-if="$page.props.user" class="btn btn-info" :href="route('items.edit', topicos.id)">
                    Reponder
             </inertia-link>
             </h4> 
             <ul v-for="comentario in comentarios" :key="comentario.id" class="list-group list-group-flush">
                <li class="list-group-item">
                    {{comentario.comentario}} - {{comentario.name}} {{ format_date(comentario.created_at) }}
                    
                    <a v-if="$page.props.user" :href="route('subs.create', [comentario.id, topicos.id])">
                        Reponder
                    </a>
                    <ul v-for="subcomentario in subcomentarios" :key="subcomentario.id" class="list-group list-group-flush ml-5">
                        <li v-if="subcomentario.idcomentario === comentario.id" class="list-group-item">
                            {{subcomentario.comentario}} - {{subcomentario.name}} {{ format_date(subcomentario.created_at) }}
                        </li>
                    </ul>    
                </li>
             </ul>
        </div>
    </div>
    </app-layout>
</template>
<script>
import HeaderLayout from "@/Layouts/HeaderLayout";
import AppLayout from "@/Layouts/AppLayout";

import moment from "moment";

export default {
    components: {
        HeaderLayout,
        AppLayout
    },

    props: {
        topicos: Object,
        comentarios: Object,
        subcomentarios: Object
    },

    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format("H:MM D/M/Y");
            }
        }
    }
}
</script>