<script setup>
    import Post from './Partials/Post.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        post: {
            type: Object,
        },
    })

    const title = `Post`;
</script>

<template>
    <Head :title="title" />
    
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title }}</h2>
        </template>
        
        <Post
            :post="post"
        />
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title }}</h2>
        </template>
        
        <Post
            :post="post"
        />
    </GuestLayout>

</template>
