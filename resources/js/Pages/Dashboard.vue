<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  people: {type: Object}
});

</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">Full name</th>
              <th class="pb-4 pt-6 px-6">Birthdate</th>
              <th class="pb-4 pt-6 px-6">Age</th>
              <th class="pb-4 pt-6 px-6">Savings</th>
            </tr>
            <tr v-if="people.data.length === 0" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td>No data</td>
            </tr>
            <tr v-for="person in people.data" :key="person.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t"><div class="flex items-center px-6 py-4">{{ person.full_name }}</div></td>
              <td class="border-t"><div class="flex items-center px-6 py-4">{{ person.birthdate }}</div></td>
              <td class="border-t"><div class="flex items-center px-6 py-4">{{ person.age }}</div></td>
              <td class="border-t"><div class="flex items-center px-6 py-4">{{ person.savings }}</div></td>
            </tr>
          </table>
        </div>
        <Pagination class="mt-6" :links="people.links" />

      </div>
    </div>
  </AuthenticatedLayout>
</template>
