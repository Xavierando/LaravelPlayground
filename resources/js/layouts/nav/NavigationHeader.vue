<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
const page = usePage();

const logOut = () =>{
    axios.post('/logout')
  .then(function (response) {
    router.push('/')
  })
}

</script>

<template>
    <nav class="flex items-center justify-end gap-4 mx-auto max-w-7xl bg-white/80 p-1">
        <div class="shrink flex gap-4"></div>
        <div class="flex-grow flex flex-row justify-items-start gap-4">
            <RouterLink to="/" >
                <v-btn variant="text">Home</v-btn>
            </RouterLink>
            <RouterLink variant="text" v-if="page.props.auth.user" to="/booking" base-color="white" class="m-0">
                <v-btn variant="text">Booking</v-btn>
            </RouterLink>
        </div>
        <div class="shrink flex gap-4">
            <RouterLink variant="text" v-if="!page.props.auth.user" to="/login" base-color="white"
                class="border-[#19140035] dark:border-[#3E3E3A] m-0">
                Log in
            </RouterLink>
            <RouterLink variant="text" v-if="!page.props.auth.user" :to="route('register')" base-color="white"
                class="border-[#19140035] dark:border-[#3E3E3A] m-0">
                Register
            </RouterLink>
            <div v-if="page.props.auth.user">
                <form method="POST" action="/logout" @submit.prevent="logOut()">
                    <v-btn variant="text" type="submit" base-color="white"
                    class="m-0 inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Logout
                </v-btn>
                </form>
            </div>
        </div>
    </nav>
</template>