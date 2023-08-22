<template>
    <div :class="classes">
        <label class="form-label">

            <slot name="label">
                {{ label }}
                <span v-if="required" class="text-danger">*</span>
            </slot>

        </label>
        <div class="input-group">
            <template v-if="hasLeft">
                <span class="input-group-text">
                    <slot name="left"> </slot>
                </span>
            </template>

            <input :type="type" v-bind="$attrs" class="form-control form-control-lg" :class="{ 'is-invalid': showErrors }"
                v-model="inputValue" :placeholder="placeholder" :aria-label="ariaLabel" :required="required">

            <template v-if="hasRight">
                <span class="input-group-text">
                    <slot name="right"> </slot>
                </span>
            </template>
        </div>
        <FormErrors :errors="inputErrors" v-if="showErrors" />
    </div>
</template>

<script>
import FormErrors from '@/components/forms/FormErrors.vue';

export default {
    name: 'Input',
    components: { FormErrors },
    data() {
        return {
            inputValue: this.value || "",
            inputErrors: []
        };
    },
    props: {
        label: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String,
            default: ''
        },
        classes: {
            type: String,
            default: 'col-12 mb-3'
        },
        ariaLabel: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        errors: {
            type: Array,
            default: () => []
        },
    },
    computed: {
        hasLeft() {
            return !!this.$slots.left;
        },
        hasRight() {
            return !!this.$slots.right;
        },
        showErrors() {
            return this.inputErrors.length > 0;
        }
    },
    watch: {
        value(newVal) {
            this.inputValue = newVal;
        },
        errors(newErrors) {
            this.inputErrors = newErrors;
        }
    },
    model: {
        prop: "value",
        event: "input"
    }
}
</script>
