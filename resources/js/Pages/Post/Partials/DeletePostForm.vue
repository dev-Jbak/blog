<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingPostDeletion = ref(false);

const props = defineProps({
    post: {
        type: Object,
    },
});

const form = useForm({});

const confirmPostDeletion = () => {
    confirmingPostDeletion.value = true;
};

const closeModal = () => {
    confirmingPostDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <DangerButton @click="confirmPostDeletion">Delete</DangerButton>

        <Modal :show="confirmingPostDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this {{ post.title }}?
                </h2>

                <div class="mt-6 flex items-center gap-4 justify-end">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

                    <form @submit.prevent="form.delete(route('post.destroy', { post: post.id }))">
                        <DangerButton
                            class="ms-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Delete post
                        </DangerButton>
                    </form>
                </div>
            </div>
        </Modal>
    </section>
</template>
