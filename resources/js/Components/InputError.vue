<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm m-0 text-danger">
            {{ message }}
        </p>
    </div>
</template>
