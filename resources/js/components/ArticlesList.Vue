<template>
    <div>
        <table class="w-full max-w-full mb-4 divide-y-4">
            <thead>
                <tr>
                    <th class="text-left">Image</th>
                    <th class="text-left">Titre</th>
                    <th class="text-left">Catégorie</th>
                    <th class="text-left">Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="article in articles"
                    :key="article.id"
                    class="divide-y"
                >
                    <td class="w-2/12">
                        <img
                            v-if="article.image"
                            :src="
                                isExternalUrl(article.image)
                                    ? article.image
                                    : `/images/${article.image}`
                            "
                            :alt="article.title"
                            class="image-size"
                        />
                        <span v-else>Pas d'image</span>
                    </td>
                    <td class="w-3/12">{{ article.title }}</td>
                    <td class="w-2/12">{{ article.category }}</td>
                    <td
                        :class="`w-2/12 px-1 ${getStatusColorClass(
                            article.status
                        )} bg-opacity-30`"
                    >
                        {{ article.status }}
                    </td>
                    <td class="w-3/12">
                        <div class="flex flex-wrap justify-center gap-2">
                            <router-link
                                :to="`/articles/${article.id}`"
                                class="p-2 lg:my-2 px-4 border text-center rounded text-white py-1 px-3 bg-blue-600 hover:bg-blue-900"
                                >Voir le détail</router-link
                            >
                            <router-link
                                :to="`/articles/${article.id}/edit`"
                                class="p-2 lg:my-2 px-4 border text-center rounded text-white py-1 px-3 bg-green-500 hover:bg-green-700"
                                >Modifier</router-link
                            >
                            <button
                                @click="deleteArticle(article.id)"
                                type="button"
                                class="p-2 lg:my-2 px-4 border text-center rounded text-white py-1 px-3 bg-red-600 hover:bg-red-700"
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

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { STATUS_COLORS } from "../constants/status";
import { isExternalUrl } from "../helpers/fonctions";

const articles = ref([]);

const getStatusColorClass = (status) => {
    const statusKey = Object.keys(STATUS_COLORS).find(
        (key) => STATUS_COLORS[key].label === status
    );
    return statusKey ? STATUS_COLORS[statusKey].color : "";
};

async function fetchArticles() {
    try {
        const response = await axios.get("/api/articles");
        articles.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function deleteArticle(id) {
    const userConfirmed = window.confirm(
        "Êtes-vous sûr de vouloir supprimer cet article ?"
    );

    if (!userConfirmed) {
        return;
    }

    try {
        await axios.delete(`/api/articles/${id}`);
        articles.value = articles.value.filter((article) => article.id !== id);
        toast(`L'article a bien été supprimé.`, {
            type: "success",
            autoClose: 1500,
        });
    } catch (error) {
        console.error(error);
        toast(`Erreur lors de la suppression de l'article : ${error.message}`, {
            type: "error",
            autoClose: 2000,
        });
    }
}

onMounted(fetchArticles);
</script>

<style>
.image-size {
    max-height: 100px !important;
    max-width: 95% !important;
}
</style>
