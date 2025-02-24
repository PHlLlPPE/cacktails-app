<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import axios from 'axios';

const emit = defineEmits(['cocktail-added']);
const ingredients = ref([]);
const cocktail = ref({ name: '', description: '', image: '', ingredients: [] });

const fetchIngredients = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/ingredients');
    ingredients.value = response.data;
  } catch (error) {
    console.error('Erreur lors du chargement des ingrédients', error);
  }
};

const addCocktail = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/cocktails', cocktail.value);
    cocktail.value = { name: '', description: '', image: '', ingredients: [] }; // Reset du formulaire
    emit('cocktail-added'); // Notification de mise à jour
  } catch (error) {
    console.error("Erreur lors de l'ajout du cocktail", error);
  }
};

onMounted(fetchIngredients);
</script>

<template>
  <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
    <h2 class="text-2xl font-bold mb-4">Ajouter un Cocktail</h2>

    <form @submit.prevent="addCocktail">
      <label class="block mb-1">Nom du Cocktail :</label>
      <input v-model="cocktail.name" type="text" class="w-full border rounded p-2 mb-2">

      <label class="block mb-1">Description :</label>
      <textarea v-model="cocktail.description" class="w-full border rounded p-2 mb-2"></textarea>

      <label class="block mb-1">Image (URL) :</label>
      <input v-model="cocktail.image" type="text" class="w-full border rounded p-2 mb-2">

      <label class="block mb-1">Ingrédients :</label>
      <div v-for="ingredient in ingredients" :key="ingredient.id" class="flex items-center">
        <input type="checkbox" v-model="cocktail.ingredients" :value="ingredient.id" class="mr-2">
        <span>{{ ingredient.name }}</span>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">Ajouter</button>
    </form>
  </div>
</template>
