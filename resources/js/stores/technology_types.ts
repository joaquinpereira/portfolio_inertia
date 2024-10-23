import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';


export const useTechnologyTypeStore = defineStore('technology_types', () => {

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
    const form = useForm('technology_types',{
        id: null,
        name: '',
        icon: '',
        description: '',
    });


    return { columnsIndexTable, form }
})

