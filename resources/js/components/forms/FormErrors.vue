<template>
    <div>

        <div v-for="(errorMessages, field) in errors" :key="field">
            <span v-for="message in errorMessages" :key="message" class="text-danger">
                {{ message }}
            </span>
        </div>

    </div>
</template>

<script>
export default {
    name: 'FormErrors',
    props: {
        errors: Object
    }
};
</script>
