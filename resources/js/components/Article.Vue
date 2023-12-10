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

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const article = ref({});
const isLoading = ref(true);

async function fetchArticle() {
    const articleId = route.params.id;
    if (articleId) {
        try {
            isLoading.value = true;
            const response = await axios.get(`/api/articles/${articleId}`);
            article.value = response.data;
        } catch (e) {
            console.error("Erreur lors de la récupération de l'article:", e);
        } finally {
            isLoading.value = false;
        }
    }
}

onMounted(fetchArticle);
</script>
