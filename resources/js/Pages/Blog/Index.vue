<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Blog from './Partials/Blog.vue';

    const props = defineProps({
        posts: {
            type: Object,
        },
        search: {
            type: String,
        },
    })
</script>

<template>    
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Blog</h2>
        </template>
        
        <Blog
            :posts="posts"
        />
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Blog</h2>
        </template>

        <Blog
            :posts="posts"
        />
    </GuestLayout>

</template>
