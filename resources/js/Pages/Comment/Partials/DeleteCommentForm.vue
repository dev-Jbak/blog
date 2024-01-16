<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const confirmingCommentDeletion = ref(false);

const props = defineProps({
    comment: {
        type: Object,
    },
});

const form = useForm({});

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
        <DangerButton @click="confirmCommentDeletion">Delete</DangerButton>

        <Modal :show="confirmingCommentDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this comment?
                </h2>

                <div class="mt-6 flex items-center gap-4 justify-end">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

                    <form @submit.prevent="form.delete(route('comment.destroy', { comment: comment.id }))">
                        <DangerButton
                            class="ms-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Delete comment
                        </DangerButton>
                    </form>
                </div>
            </div>
        </Modal>
    </section>
</template>
