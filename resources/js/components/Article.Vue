<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Nom:</h5>
        <h6>{{ article.title }}</h6>
        <h5 id="associating-form-text-with-form-controls">Contenu:</h5>
        <p>{{ article.description }}</p>
        <h5 id="associating-form-text-with-form-controls">Catégorie:</h5>
        <p>Catégorie: {{ article.category }}</p>
        <h5 id="associating-form-text-with-form-controls">Statut:</h5>
        <p>Statut: {{ article.status }}</p>
        <router-link
            :to="`/articles/${article.id}/edit`"
            class="btn btn-primary"
            >Modifier</router-link
        >
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            article: {},
        };
    },
    async created() {
        try {
            const response = await axios.get(
                `/api/articles/${this.$route.params.id}`
            );
            this.article = response.data;
        } catch (error) {
            console.error(error);
        }
    },
};
</script>
