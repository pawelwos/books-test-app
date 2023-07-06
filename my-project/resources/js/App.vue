<template>
    <div class="flex items-center min-h-screen">
        <div class="container mx-auto">
            <h1 class="text-center text-lg md:text-2xl font-bold text-primary uppercase py-8">Books demo app <span class="text-base-content normal-case">by Pawel Wos</span></h1>
            <Books />
        </div>
    </div>
</template>
  
<script setup>
    import Books from './components/BooksList.vue'
</script>