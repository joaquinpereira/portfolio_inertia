import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';


export const useTechnologiesStore = defineStore('technologies', () => {

    const columnsIndexTable = [
        {
          key: 'id',
          label: '#',
          _props: { scope: 'col' },
        },
        {
          key: 'name',
          label: 'Nombre',
          _props: { scope: 'col' },
        },
        {
          key: 'icon',
          label: 'Icono',
          _props: { scope: 'col' },
        },
        {
            label: 'Acciones',
            _props: { scope: 'col' },
        },
    ]

    const formIsValid = ref(false)
    const form = useForm('technologies',{
        id: null,
        technology_types_id: null,
        active: false,
        name: '',
        icon: '',
        description: '',
    });


    return { columnsIndexTable, form }
})

