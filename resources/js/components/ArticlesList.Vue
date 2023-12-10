<template>
    <div>
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead>
                <tr>
                    <th class="text-left">#</th>
                    <th class="text-left">Titre</th>
                    <th class="text-left">Catégorie</th>
                    <th class="text-left">Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="mt-4">
                <tr v-for="article in articles" :key="article.id">
                    <td class="w-1/12">{{ article.id }}</td>
                    <td class="w-4/12">{{ article.title }}</td>
                    <td class="w-2/12">{{ article.category }}</td>
                    <td class="w-2/12">{{ article.status }}</td>
                    <td class="w-3/12">
                        <div class="flex flex-wrap justify-center gap-3">
                            <router-link
                                :to="`/articles/${article.id}`"
                                class="p-2 px-4border text-center rounded text-white py-1 px-3 bg-blue-600 hover:bg-blue-900"
                                >Voir le détail</router-link
                            >
                            <router-link
                                :to="`/articles/${article.id}/edit`"
                                class="p-2 px-4 border text-center rounded text-white py-1 px-3 bg-green-500 hover:bg-green-700"
                                >Modifier</router-link
                            >
                            <button
                                @click="deleteArticle(article.id)"
                                type="button"
                                class="p-2 px-4 border text-center rounded text-white py-1 px-3 bg-red-600 hover:bg-red-700"
                            >
                                Supprimer
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            articles: [],
        };
    },
    async created() {
        try {
            const response = await axios.get("/api/articles");
            this.articles = response.data;
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        async deleteArticle(id) {
            try {
                await axios.delete(`/api/articles/${id}`);
                this.articles = this.articles.filter(
                    (article) => article.id !== id
                );
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
