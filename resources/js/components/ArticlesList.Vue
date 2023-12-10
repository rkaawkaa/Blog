<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="article in articles" :key="article.id">
                    <td>{{ article.id }}</td>
                    <td>{{ article.title }}</td>
                    <td>{{ article.description }}</td>
                    <td>{{ article.category }}</td>
                    <td>
                        <div class="row gap-3">
                            <router-link
                                :to="`/articles/${article.id}`"
                                class="p-2 col border btn btn-primary"
                                >View</router-link
                            >
                            <router-link
                                :to="`/articles/${article.id}/edit`"
                                class="p-2 col border btn btn-success"
                                >Edit</router-link
                            >
                            <button
                                @click="deleteArticle(article.id)"
                                type="button"
                                class="p-2 col border btn btn-danger"
                            >
                                Delete
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
