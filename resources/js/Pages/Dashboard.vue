<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


import { CContainer } from '@coreui/vue'
import AppFooter from '@/Components_core_ui/AppFooter.vue'
import AppHeader from '@/Components_core_ui/AppHeader.vue'
import AppSidebar from '@/Components_core_ui/AppSidebar.vue'
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!  lololo
                    </div>
                </div>
            </div>
        </div> -->
        <div>
            <AppSidebar />
            <div class="wrapper d-flex flex-column min-vh-100">
                <AppHeader />
                <div class="body flex-grow-1">
                    <CContainer class="px-4" lg>
                        s hola mama
                    </CContainer>
                </div>
                <AppFooter />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
