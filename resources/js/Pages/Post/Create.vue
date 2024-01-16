<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';

    const props = defineProps({});

    const title = "Create post";

    const form = useForm({
        post_title: '',
        post_body: '',
    });
</script>

<template>
    <Head :title="title" />
    
    <AuthenticatedLayout :full-width="false">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title }}</h2>
        </template>
        
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Create a new post</h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Add a new post to the blog
                </p>
            </header>

            <form @submit.prevent="form.post(route('post.store'))" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="post_title" value="Title" />

                    <TextInput
                        id="post_title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.post_title"
                        required
                        autofocus
                        autocomplete="post_title"
                    />

                    <InputError class="mt-2" :message="form.errors.post_title" />
                </div>

                <div>
                    <InputLabel for="post_body" value="Body" />

                    <TextInput
                        id="post_body"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.post_body"
                        required
                        autofocus
                        autocomplete="post_body"
                    />

                    <InputError class="mt-2" :message="form.errors.post_body" />
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
