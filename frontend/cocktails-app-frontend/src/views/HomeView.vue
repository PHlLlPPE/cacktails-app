<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import CreateCocktail from '@/components/CreateCocktail.vue';

const cocktails = ref([]);
const ingredients = ref([]); // 🔹 Stocke tous les ingrédients disponibles
const loading = ref(true);
const editingCocktail = ref(null);
const editForm = ref({ name: '', description: '', image: '', ingredients: [] });

const fetchCocktails = () => {
  axios.get('http://127.0.0.1:8000/api/cocktails')
    .then(response => {
      cocktails.value = response.data;
      loading.value = false;
    })
    .catch(error => {
      console.error("Erreur lors du chargement des cocktails", error);
      loading.value = false;
    });
};

const fetchIngredients = () => {
  axios.get('http://127.0.0.1:8000/api/ingredients') // 🔹 Charger tous les ingrédients
    .then(response => {
      ingredients.value = response.data;
    })
    .catch(error => {
      console.error("Erreur lors du chargement des ingrédients", error);
    });
};

onMounted(() => {
  fetchCocktails();
  fetchIngredients(); // 🔹 Charger les ingrédients dès le départ
});

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

const editCocktail = (cocktail) => {
  editingCocktail.value = cocktail;
  editForm.value = {
    name: cocktail.name,
    description: cocktail.description,
    image: cocktail.image,
    ingredients: cocktail.ingredients.map(i => i.id) // 🔹 Stocker les IDs des ingrédients
  };
};

const updateCocktail = async () => {
  if (!editingCocktail.value) return;

  try {
    await axios.put(`http://127.0.0.1:8000/api/cocktails/${editingCocktail.value.id}`, editForm.value);
    editingCocktail.value = null;
    fetchCocktails();
  } catch (error) {
    console.error("Erreur lors de la mise à jour du cocktail", error);
  }
};
</script>

<template>
  <div class="container mx-auto p-6">

    <CreateCocktail @cocktail-added="fetchCocktails" />

    <div v-if="editingCocktail" class="mt-6 p-4 border rounded bg-gray-100">
      <h2 class="text-xl font-bold mb-4">Modifier le Cocktail</h2>

      <label class="block">Nom :</label>
      <input v-model="editForm.name" type="text" class="w-full border p-2 rounded mb-2">

      <label class="block">Description :</label>
      <textarea v-model="editForm.description" class="w-full border p-2 rounded mb-2"></textarea>

      <label class="block">Image (URL) :</label>
      <input v-model="editForm.image" type="text" class="w-full border p-2 rounded mb-2">

      <!-- Sélection des ingrédients avec des cases à cocher -->
      <label class="block font-bold mb-2">Ingrédients :</label>
      <div v-for="ingredient in ingredients" :key="ingredient.id" class="flex items-center">
        <input type="checkbox" :value="ingredient.id" v-model="editForm.ingredients" class="mr-2">
        <span>{{ ingredient.name }}</span>
      </div>

      <div class="flex gap-2 mt-4">
        <button @click="updateCocktail" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-700">
          ✅ Enregistrer
        </button>
        <button @click="editingCocktail = null" class="bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-700">
          ❌ Annuler
        </button>
      </div>
    </div>

    <!-- Affichage des cocktails -->
    <h1 class="text-3xl font-bold mb-4">Liste des Cocktails</h1>
    <div v-if="loading" class="text-gray-500 mt-4">Chargement...</div>
    <div v-else class="mt-4">
      <ul>
        <li v-for="cocktail in cocktails" :key="cocktail.id" class="p-4 border-b flex justify-between items-center">
          <div>
            <h2 class="text-xl font-semibold">{{ cocktail.name }}</h2>
            <p>{{ cocktail.description }}</p>
            <img :src="cocktail.image" alt="Cocktail" class="w-32 h-32 object-cover mt-2">
            <p class="text-sm text-gray-600">
              <strong>Ingrédients :</strong>
              <span v-for="ingredient in cocktail.ingredients" :key="ingredient.id">
                {{ ingredient.name }}{{ cocktail.ingredients.length > 1 ? ', ' : '' }}
              </span>
            </p>
          </div>

          <button @click="editCocktail(cocktail)" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-700">
            Modifier
          </button>

          <button @click="deleteCocktail(cocktail.id)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-700">
            Supprimer
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>
