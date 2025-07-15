<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import NavigationHeader from '@/layouts/nav/NavigationHeader.vue';
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="relative bg-[url(@images/home.png)] bg-center bg-scroll bg-cover h-screen w-screen bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
        <header class="absolute top-0 left-0 mb-6 w-full text-sm not-has-[nav]:hidden">
            <NavigationHeader />
        </header>
        <main class=" h-screen w-screen grid grid-col-8 gap-4 overflow-scroll">
            <RouterView />
        </main>
        <footer></footer>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
