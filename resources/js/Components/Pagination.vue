<script setup>
    defineProps({
        pagination: Object
    })
</script>

<template>
    <CPagination align="center">
        <template v-for="link in pagination.links" :key="link.label">
            <CPaginationItem :href="link.url ?? ''" :active="link.active"><span v-html="link.label"></span></CPaginationItem>
        </template>
    </CPagination>
</template>


