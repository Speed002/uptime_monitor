<template>
    <VDropdown :distance="0">
    <!-- This will be the popover target (for the events and position) -->
        <button>
            <span class="text-gray-500 hover:text-gray-700">Select a site</span>
            <!-- <svg xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg> -->
        </button>
    <!-- content of the popover -->
        <template #popper>
            <ul class="-space-y-1">
                <li v-for="site in sites" :key="site.id">
                    <Link :href="route('dashboard', site.id)" class="px-4 py-2 hover:bg-gray-100 block text-sm text-gray-500 hover:text-gray-700">{{ site.domain }}</Link>
                </li>
                <li>
                    <button v-on:click="showNewSiteModal = true" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-indigo-500 font-bold text-sm">Add a site</button>
                </li>
            </ul>
        </template>
    </VDropdown>

    <VueFinalModal v-model="showNewSiteModal" classes="flex justify-center items-start pt-16 md:pt-24 mx-4" content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6" overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50" :esc-to-close="true">
        Modal content
    </VueFinalModal>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { VueFinalModal } from 'vue-final-modal';
import { ref } from 'vue';

defineProps({
    sites:Array
})

const showNewSiteModal = ref(false)
</script>
