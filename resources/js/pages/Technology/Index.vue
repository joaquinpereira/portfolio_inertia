<template>
    <div>
        <Head title="Tecnologias" />
        <div style="text-align: center; margin-top: 5px">
            <h1>Tecnologias <CButton color="primary" shape="rounded-pill" class="me-md-2" @click="prepareModal(true, null)">Crear</CButton></h1>
            <AlertSuccess ref="refAlertSuccess"/>
            <CTable :columns="columnsIndexTable" bordered hover striped>
                <CTableBody>
                    <CTableRow v-for="technology in technologies_list" :key="technology" >
                        <CTableDataCell bordered>{{ technology.id }}</CTableDataCell>
                        <CTableDataCell bordered>{{ technology.name }}</CTableDataCell>
                        <CTableDataCell bordered><Icon :icon="technology.icon" style="font-size: 1.5rem;"/></CTableDataCell>
                        <CTableDataCell bordered>
                            <CButton color="secondary" shape="rounded-pill" class="me-md-2" @click="prepareModal(false, technology)">Editar</CButton>
                            <CButton color="danger" shape="rounded-pill" @click="deleteModal(technology)">Eliminar</CButton>
                        </CTableDataCell>
                    </CTableRow>
                </CTableBody>
            </CTable>
            <Pagination :pagination="pagination_data" />

            <CModal
                :visible="showModal"
                @close="() => { showModal = false }"
            >
                <CModalHeader>
                    <CModalTitle>{{ titleModal }}</CModalTitle>
                </CModalHeader>
                <CModalBody class="form_modal">
                    <CFormSwitch
                        id="active"
                        v-model="form.active"
                        :label="form.active ? 'Activo' : 'Inactivo'"
                        :invalid="form.errors?.active === undefined ? false : true"
                        :feedback-invalid="form.errors?.active"
                    />
                    <br/>
                    <CFormSelect
                        id="technology_types_id"
                        v-model="form.technology_types_id"
                        label="Tipo de tecnología"
                        :invalid="form.errors?.technology_types_id === undefined ? false : true"
                        :feedback-invalid="form.errors?.technology_types_id"
                    >
                        <option disabled selected>Selecciona una opción</option>
                        <option v-for="tech_type in technology_types.data" :value="tech_type.id" :key="tech_type">{{ tech_type.name }}</option>
                    </CFormSelect>
                    <br/>
                    <CFormInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        label="Nombre"
                        :invalid="form.errors?.name === undefined ? false : true"
                        :feedback-invalid="form.errors?.name"
                    />
                    <br/>
                    <CFormInput
                        id="icon"
                        type="text"
                        v-model="form.icon"
                        label="Icono"
                        :invalid="form.errors?.icon === undefined ? false : true"
                        :feedback="form.errors?.icon"
                    />
                    <br/>
                    <CFormTextarea
                        id="description"
                        v-model="form.description"
                        label="Descripción"
                        :invalid="form.errors?.description === undefined ? false : true"
                        :feedback="form.errors?.description"
                    />
                    <br/>
                    <a href="https://icon-sets.iconify.design/" target="_blank">Página de iconos</a>
                    <br/>
                    <div class="form_bottons">
                        <CButton color="primary" shape="rounded-pill" @click="handleSubmit">Guardar</CButton>
                        <CButton color="secondary" shape="rounded-pill" class="ml-2" @click="() => { showModal = false }">Cancelar</CButton>
                    </div>
                </CModalBody>
            </CModal>

            <CModal
                alignment="center"
                :visible="showDeleteModal"
                @close="() => { showDeleteModal = false }"
            >
                <CModalHeader>
                    <CModalTitle>Borrar tecnología</CModalTitle>
                </CModalHeader>
                <CModalBody class="form_modal">
                    <div>
                        <Icon :icon="form.icon" style="font-size: 1.5rem;"/> - {{ form.name }}
                    </div>
                    <div>
                       {{ form.description }}
                    </div>
                </CModalBody>
                <CModalFooter>
                    <div class="form_bottons">
                        <CButton color="danger" shape="rounded-pill" @click="destroyModel">Eliminar</CButton>
                        <CButton color="secondary" shape="rounded-pill" class="ml-2" @click="() => { showDeleteModal = false }">Cancelar</CButton>
                    </div>
                </CModalFooter>
            </CModal>

            <Spinner ref="SpinnerLoading" />

        </div>
    </div>
</template>

<script setup>
import { onBeforeMount, ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import Spinner from '@/Components/Spinner.vue'
import AlertSuccess from '@/Components/AlertSuccess.vue'
import { useTechnologiesStore } from '@/stores/technologies'
import Pagination from '@/Components/Pagination.vue'
import { Icon } from '@iconify/vue';

const props = defineProps({
    technologies: Object,
    technology_types: Object,
});

const { columnsIndexTable, form } = useTechnologiesStore()
const technologies_list = ref([])
const pagination_data = ref('')
const showModal = ref(false)
const showDeleteModal = ref(false)
const SpinnerLoading = ref(null)
const refAlertSuccess = ref(null)

const titleModal = ref('')
const isNewModel = ref(false)
const prepareModal = (isNew, model) => {
    titleModal.value = isNew ? 'Creación de tecnología' : 'Edición de tecnología'
    isNewModel.value = isNew
    form.clearErrors()
    if(model != null){
        setValuesInForm(model);
    }else{
        form.reset()
    }
    showModal.value = true
}


const deleteModal = (model) => {
    setValuesInForm(model);
    showDeleteModal.value = true
}

const setValuesInForm = (model) => {
    form.id = model.id
    form.technology_types_id = model.technology_types_id
    form.active = model.active
    form.name = model.name
    form.icon = model.icon
    form.description = model.description
}
const handleSubmit = () => {
    isNewModel.value ? saveModel() : updateModel()
}

const saveModel = () => {
    SpinnerLoading.value.show()
    form.post(route('technologies.store'), {
        preserveScroll: true,
        onSuccess: () => {
            refAlertSuccess.value.show('Registro guardado con éxito!')
            prepareTable()
            form.reset()
            showModal.value = false
        },
        onFinish: () => { SpinnerLoading.value.hide() }
    })
}

const updateModel = () => {
    SpinnerLoading.value.show()
    form.put(route('technologies.update', form.data()), {
        preserveScroll: true,
        onSuccess: () => {
            refAlertSuccess.value.show('Edición guardada con éxito!')
            prepareTable()
            form.reset()
            showModal.value = false
        },
        onFinish: () => { SpinnerLoading.value.hide() }
    })
}

const destroyModel = () => {
    SpinnerLoading.value.show()
    form.delete(route('technologies.destroy', form.data()), {
        preserveScroll: true,
        onSuccess: () => {
            refAlertSuccess.value.show('Registro borrado con éxito!')
            prepareTable()
            form.reset()
            showDeleteModal.value = false
        },
        onFinish: () => { SpinnerLoading.value.hide() }
    })
}

const prepareTable = () => {
    technologies_list.value = props.technologies?.data;
    pagination_data.value = props.technologies?.meta;
}

onBeforeMount(() =>{
    prepareTable();
})
</script>

<style lang="scss" scoped>
.form_modal{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    text-align: left;
}
.form_bottons{
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}
</style>
