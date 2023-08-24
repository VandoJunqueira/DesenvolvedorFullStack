<template>
    <div v-if="toggle">
        <div class="modal modal-fullscreen-sm-down fade show" id="Modal" tabindex="-1" aria-labelledby="ModalLabel"
            aria-hidden="true" style="display:block;">
            <div class="modal-dialog modal-dialog-scrollable" :class="[size]">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">{{ title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            @click="toggleFun"></button>
                    </div>
                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    </div>
</template>


<script>

export default {
    name: 'Modal',
    props: {
        title: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'modal-lg'
        },
        visible: Boolean,
    },
    emits: ['setVisible'],
    data() {
        return {
            toggle: this.visible
        }
    },
    methods: {
        toggleFun() {
            this.toggle = false;
            this.$emit('setVisible', {
                visible: false
            });
        },
    },
    watch: {
        visible: function (newVal, oldVal) { // watch it
            this.toggle = newVal;
        }
    }
}

</script>

<style scoped>
.modal {
    z-index: 2147483650 !important;
}
</style>
