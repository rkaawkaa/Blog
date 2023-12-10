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

<script>
import axios from "axios";

export default {
    data() {
        return {
            article: {
                title: "",
                description: "",
                category: "",
                status: "",
                image: "",
            },
        };
    },
    computed: {
        isNewArticle() {
            return !this.$route.path.includes("edit");
        },
    },
    async created() {
        if (!this.isNewArticle) {
            const response = await axios.get(
                `/api/articles/${this.$route.params.id}`
            );
            this.article = response.data;
        }
    },
    methods: {
        async submitForm() {
            try {
                if (this.isNewArticle) {
                    await axios.post("/api/articles", this.article);
                } else {
                    await axios.put(
                        `/api/articles/${this.$route.params.id}`,
                        this.article
                    );
                }
                this.$router.push("/");
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
