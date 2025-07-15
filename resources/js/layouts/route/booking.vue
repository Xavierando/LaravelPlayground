<script setup lang="ts">
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<template>
    Booking {{ route.params.service }}
    <div>
        
    </div>
</template>