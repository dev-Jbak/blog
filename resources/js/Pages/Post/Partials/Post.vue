<script setup>
    import EditPostForm from './EditPostForm.vue';
    import DeletePostForm from './DeletePostForm.vue';
    import EditCommentForm from '../../Comment/Partials/EditCommentForm.vue';
    import DeleteCommentForm from '../../Comment/Partials/DeleteCommentForm.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { useForm, usePage } from '@inertiajs/vue3'

    const props = defineProps({
        post: {
            type: Object,
        },
    });

    const authUserId = usePage().props.auth.user?.id;

    const form = useForm({
        body: ''
    });
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                    
                <div class="flex flex-col gap-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-6xl font-bold dark:text-white">{{ post.title }}</h2>

                        <div v-if="authUserId === post.user_id" class="flex gap-3">
                            <EditPostForm :post="post" />
                            <DeletePostForm :post="post" />
                        </div>
                    </div>

                    <p class="text-xl dark:text-white">
                        {{ post.body }}
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="mb-6 text-xl font-bold text-gray-900 dark:text-gray-100">Comments</h2>

                <div class="flex flex-col gap-6">
                    <div
                        v-for="comment in post.comments"
                        class="bg-slate-800 p-3 rounded-lg flex items-center justify-between"
                    >
                        <div>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{  comment.body }}</p>
    
                            <p class="mt-1 text-sm font-bold text-gray-700 dark:text-gray-400">
                                {{  comment.user.name }}
                            </p>
                        </div>

                        <div v-if="authUserId === comment.user_id" class="flex gap-3">
                            <EditCommentForm :comment="comment" />
                            <DeleteCommentForm :comment="comment" />
                        </div>
                    </div>
                </div>

                <form @submit.prevent="form.post(route('comment.store', { post_id: post.id }))" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="body" value="Add comment" />

                        <TextInput
                            id="body"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.body"
                            required
                            autofocus
                            autocomplete="body"
                        />

                        <InputError class="mt-2" :message="form.errors.body" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Post</PrimaryButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Comment added.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>