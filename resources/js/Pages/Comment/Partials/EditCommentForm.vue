<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const confirmingCommentDeletion = ref(false);

const props = defineProps({
    comment: {
        type: Object,
    },
});

const form = useForm({
    comment_body: props.comment.body,
});

const confirmCommentDeletion = () => {
    confirmingCommentDeletion.value = true;
};

const closeModal = () => {
    confirmingCommentDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <SecondaryButton @click="confirmCommentDeletion">Edit</SecondaryButton>

        <Modal :show="confirmingCommentDeletion" @close="closeModal">
            <div class="p-6 flex flex-col gap-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Edit Comment
                </h2>

                <form
                    @submit.prevent="form.patch(route('comment.update', { comment: comment.id }))"
                    class="flex flex-col gap-3"
                >
                    <div>
                        <InputLabel for="comment_body" value="Body" />

                        <TextInput
                            id="comment_body"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.comment_body"
                            autofocus
                            autocomplete="comment_body"
                        />

                        <InputError class="mt-2" :message="form.errors.comment_body" />
                    </div>

                    <div class="mt-6 flex gap-4 justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <div class="flex gap-4">
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
                    </div>
                </form>
            </div>
        </Modal>
    </section>
</template>
