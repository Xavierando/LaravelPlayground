<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';

const services = ref({ "data": [] });

// Make a request for a user with a given ID
axios.get(route('api.services.index'))
    .then(function (response) {
        services.value = response.data;
    });

</script>
<template>
    <div>
        <div class="col-span-1 col-start-6 h-[80vh] flex  items-center ">
            <button class="bg-blue-600 rounded-md px-8 py-3 hover:cursor-pointer">Booking</button>
        </div>
        <div class="col-span-8 col-start-1 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-auto max-w-7xl">
            <v-card v-for="service in services.data" variant="elevated" class="mx-auto" color="surface-variant"
                :title="service.attributes.title" :text="service.attributes.description">
                <template v-slot:actions>
                    <RouterLink :to="'/booking/'+service.id">
                        Booking
                    </RouterLink>
                </template>
            </v-card>
        </div>
        <div class="col-span-8 col-start-1 h-[20vh]">
        </div>
    </div>
</template>