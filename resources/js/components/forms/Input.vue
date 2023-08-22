<template>
    <div :class="classes">
        <label class="form-label">

            <slot name="label"> {{ label }}</slot>

        </label>
        <div class="input-group">
            <template v-if="hasLeft">
                <span class="input-group-text">
                    <slot name="left"> </slot>
                </span>
            </template>
            <input v-bind="$attrs" class="form-control form-control-lg" v-model="inputValue" :placeholder="placeholder"
                :aria-label="ariaLabel">
            <template v-if="hasRight">
                <span class="input-group-text">
                    <slot name="right"> </slot>
                </span>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Input',
    data() {
        return {
            inputValue: this.value || ""
        };
    },
    props: {
        label: {
            type: String,
            default: ''
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
    },
    computed: {
        hasLeft() {
            return !!this.$slots.left;
        },
        hasRight() {
            return !!this.$slots.right;
        }
    },
    watch: {
        value(newVal) {
            this.inputValue = newVal;
        }
    },
    model: {
        prop: "value",
        event: "input"
    }
}
</script>
