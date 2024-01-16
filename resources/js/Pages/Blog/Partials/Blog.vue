<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        posts: {
            type: Object,
        },
        search: {
            type: String,
            default: ''
        },
    })

    const form = useForm({
        search: props.search,
    });
</script>

<template>
    <Head title="Blog" />

    <div class="flex flex-col gap-8 max-w-7xl mx-auto">
        <form
            @submit.prevent="form.get(route('index'))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="search" value="Search" />

                <TextInput
                    id="search"
                    name="search"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.search"
                    autofocus
                    autocomplete="search"
                />

                <InputError class="mt-2" :message="form.errors.search" />
            </div>
        </form>

        <div class="sm:px-6 lg:px-8 min-h-96">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-wrap justify-between">
                    <Link
                        v-if="posts.data.length"
                        v-for="post in posts.data"
                        :href="route('post.show', { post: post.id })"
                        class="w-1/2 cursor-pointer"
                    >
                        <div class="flex flex-col bg-white m-3 rounded-lg">
                            <div class="bg-gray-300 text-xl font-bold px-6 py-3 rounded-t-lg">
                                <p>{{ post.title }}</p>
                                <p class="mt-1 text-sm font-bold text-gray-700 dark:text-gray-400">{{ post.user.name }}</p>
                            </div>
                            
                            <div class="bg-slate-400 px-6 py-3 rounded-b-lg">
                                {{ post.short_body }}
                            </div>
                        </div>
                    </Link>
                    
                    <div
                        v-else
                        class="flex flex-grow justify-center"
                    >
                        <p class="text-xl text-white">No posts to show</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-2 justify-center">
            <Link
                v-for=" (link, index) in posts.links" 
                :key="index" 
                :href="link.url || ''"
                :class="[{
                    'dark:text-gray-200 font-bold': posts.current_page == link.label,
                    'dark:text-gray-500': posts.current_page != link.label
                }]"
                class="px-1 py-2.5 px-5 me-2 mb-2 text-sm text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-xl rounded"
                v-html="link.label"
            />
        </div>
    </div>
</template>