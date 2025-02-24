<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import CreateCocktail from '@/components/CreateCocktail.vue';

const cocktails = ref([]);
const loading = ref(true);

const fetchCocktails = () => {
  axios.get('http://127.0.0.1:8000/api/cocktails')
    .then(response => {
      console.log("Données reçues :", response.data); // ✅ Ajout du log
      cocktails.value = response.data;
      loading.value = false;
    })
    .catch(error => {
      console.error("Erreur lors du chargement des cocktails", error);
      loading.value = false;
    });
};

onMounted(fetchCocktails);

const deleteCocktail = (id) => {
  if (!confirm("Êtes-vous sûr de vouloir supprimer ce cocktail ?")) {
    return;
  }

  axios.delete(`http://127.0.0.1:8000/api/cocktails/${id}`)
    .then(() => {
      cocktails.value = cocktails.value.filter(cocktail => cocktail.id !== id);
    })
    .catch(error => {
      console.error("Erreur lors de la suppression du cocktail", error);
    });
};

</script>

<template>
  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Liste des Cocktails</h1>

    <!-- Formulaire pour ajouter un cocktail -->
    <CreateCocktail @cocktail-added="fetchCocktails" />

    <!-- Affichage des cocktails -->
    <div v-if="loading" class="text-gray-500 mt-4">Chargement...</div>
    <div v-else class="mt-4">
      <ul>
        <li v-for="cocktail in cocktails" :key="cocktail.id" class="p-4 border-b flex justify-between items-center">
          <div>
            <h2 class="text-xl font-semibold">{{ cocktail.name }}</h2>
            <p>{{ cocktail.description }}</p>
            <img :src="cocktail.image" alt="Cocktail" class="w-32 h-32 object-cover mt-2">
          </div>
          
          <!-- Bouton Supprimer -->
          <button @click="deleteCocktail(cocktail.id)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-700">
            🗑 Supprimer
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

