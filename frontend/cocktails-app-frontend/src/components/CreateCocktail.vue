<script setup>
import { ref, defineEmits } from 'vue';
import axios from 'axios';

const cocktail = ref({
  name: '',
  description: '',
  image: '',
});

const message = ref('');
const emit = defineEmits(['cocktail-added']);

const submitForm = () => {
  axios.post('http://127.0.0.1:8000/api/cocktails', cocktail.value)
    .then(() => {
      message.value = "Cocktail ajouté avec succès ! 🎉";
      cocktail.value = { name: '', description: '', image: '' };
      emit('cocktail-added'); // Mettre à jour la liste des cocktails
    })
    .catch(error => {
      console.error("Erreur lors de l'ajout du cocktail", error);
    });
};
</script>

<template>
  <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Ajouter un Cocktail</h2>

    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block text-gray-700">Nom du Cocktail :</label>
        <input v-model="cocktail.name" type="text" class="w-full border rounded p-2" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Description :</label>
        <textarea v-model="cocktail.description" class="w-full border rounded p-2" required></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Image (URL) :</label>
        <input v-model="cocktail.image" type="text" class="w-full border rounded p-2">
      </div>

      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
        Ajouter
      </button>
    </form>

    <p v-if="message" class="text-green-600 mt-4">{{ message }}</p>
  </div>
</template>
