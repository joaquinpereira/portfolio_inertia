<template>
    <div>
        <Transition name="slide-fade">
            <CAlert v-if="showAlert" color="success" class="d-flex align-items-center" dismissible>
                <CIcon icon="cil-check-circle" class="flex-shrink-0 me-2" width="24" height="24" />
                <div>
                    {{ message }}
                </div>
            </CAlert>
        </Transition>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const showAlert = ref(false)
const message = ref('')

const show = (msj) => {
    message.value = msj
    showAlert.value = true

    setTimeout(() => {
        console.log("close")
        showAlert.value = false
    }, 3000);
}

defineExpose({
  show
});

</script>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>
