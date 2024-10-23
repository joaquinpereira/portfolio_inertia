<script setup>
import { ref } from 'vue';
const show_spinner = ref(false)

const show = () => {
    show_spinner.value = true
}

const hide = () => {
    show_spinner.value = false
}

defineExpose({
  show,
  hide
});

const spinnerModal = {
  '--cui-modal-bg': 'transparent',
  '--cui-modal-border-color': 'transparent',
}
const spinnerStyles = {
  '--cui-spinner-width': '6rem',
  '--cui-spinner-height': '6rem',
  '--cui-spinner-border-width': '1rem'
}
</script>

<template>
    <div>
        <CModal
            fullscreen
            alignment="center"
            :visible="show_spinner"
            :style="spinnerModal"
            content-class-name="modal_spinner"
        >
            <div class="modal_spinner_content">
                <CSpinner color="primary" :style="spinnerStyles"/>
            </div>
        </CModal>
    </div>
</template>

<style lang="scss">
.modal_spinner{
    flex-direction: row !important;
    justify-content: center !important;
}
.modal_spinner_content{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-content: center;
    flex-wrap: wrap;
    height: 100vh;
}
</style>
