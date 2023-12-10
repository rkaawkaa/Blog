<template>
    <div>
        <h2 v-if="isNewArticle">Ajouter un article</h2>
        <h2 v-else>Modifier l'article</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="title" class="form-label">Nom:</label>
                <input
                    class="form-control"
                    type="text"
                    id="title"
                    v-model="article.title"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea
                    class="form-control"
                    id="description"
                    v-model="article.description"
                    required
                ></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie:</label>
                <input
                    class="form-control"
                    type="text"
                    id="category"
                    v-model="article.category"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Statut:</label>
                <input
                    class="form-control"
                    type="text"
                    id="status"
                    v-model="article.status"
                    required
                />
            </div>
            <button type="submit" v-if="isNewArticle" class="btn btn-primary">
                Ajouter l'article
            </button>
            <button type="submit" v-else class="btn btn-primary">
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
                    await axios.post("/api/articles", this.articles);
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
