<template>
    <div>
        <h2 v-if="isNewArticle" class="text-2xl font-bold mb-5">
            Ajouter un article
        </h2>
        <h2 v-else class="text-2xl font-bold mb-5">Modifier l'article</h2>
        <form @submit.prevent="submitForm" class="space-y-4">
            <div class="mb-3">
                <label
                    for="title"
                    class="block text-sm font-medium text-gray-700"
                    >Nom:</label
                >
                <input
                    class="mt-1 block border max-w-3xl rounded-md border-black shadow-sm focus:border-indigo-600 px-2 py-2"
                    type="text"
                    id="title"
                    v-model="article.title"
                    required
                />
            </div>
            <div class="mb-3">
                <label
                    for="description"
                    class="block text-sm font-medium text-gray-700"
                    >Description:</label
                >
                <textarea
                    class="mt-1 block w-full rounded-md border border-black shadow-sm focus:border-indigo-600 px-2 py-2"
                    id="description"
                    v-model="article.description"
                    required
                ></textarea>
            </div>
            <div class="mb-3">
                <label
                    for="category"
                    class="block text-sm font-medium text-gray-700"
                    >Catégorie:</label
                >
                <input
                    class="mt-1 block max-w-3xl rounded-md border border-black shadow-sm focus:border-indigo-600 px-2 py-2"
                    type="text"
                    id="category"
                    v-model="article.category"
                    required
                />
            </div>
            <div class="mb-3">
                <label
                    for="status"
                    class="block text-sm font-medium text-gray-700"
                    >Statut:</label
                >
                <input
                    class="mt-1 block max-w-3xl rounded-md border border-black shadow-sm focus:border-indigo-600 px-2 py-2"
                    type="text"
                    id="status"
                    v-model="article.status"
                    required
                />
            </div>
            <button
                type="submit"
                v-if="isNewArticle"
                class="p-2 px-4 border text-center rounded text-white px-3 bg-blue-600 hover:bg-blue-900"
            >
                Ajouter l'article
            </button>
            <button
                type="submit"
                v-else
                class="p-2 px-4 border text-center rounded text-white px-3 bg-blue-600 hover:bg-blue-900"
            >
                Modifier l'article
            </button>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";
import { computed, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const article = ref({
    title: "",
    description: "",
    category: "",
    status: "",
    image: "",
});

const isNewArticle = computed(() => !route.path.includes("edit"));

async function fetchArticle() {
    if (!isNewArticle.value) {
        try {
            const response = await axios.get(
                `/api/articles/${route.params.id}`
            );
            article.value = response.data;
        } catch (error) {
            console.error(error);
        }
    }
}

async function submitForm() {
    try {
        if (isNewArticle.value) {
            await axios.post("/api/articles", article.value);
        } else {
            await axios.put(`/api/articles/${route.params.id}`, article.value);
        }
        router.push("/");
    } catch (error) {
        console.error(error);
    }
}

onMounted(fetchArticle);
</script>
