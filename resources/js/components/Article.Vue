<template>
    <div class="space-y-2 mb-6">
        <p class="text-2xl font-bold">Nom:</p>
        <p class="text-xl">{{ article.title }}</p>
        <p class="text-lg font-semibold">Catégorie:</p>
        <p>{{ article.category }}</p>
        <p class="text-lg font-semibold">Statut:</p>
        <p>{{ article.status }}</p>
        <p class="text-lg font-semibold">Contenu:</p>
        <p>{{ article.description }}</p>
    </div>
    <router-link
        :to="`/articles/${article.id}/edit`"
        class="py-2 px-4 border text-center rounded bg-blue-600 text-white hover:bg-blue-900"
        >Modifier</router-link
    >
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
