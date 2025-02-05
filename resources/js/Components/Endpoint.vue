<template>
    <tr>
        <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
            <Link class="text-indigo-600 hover:text-indigo-900">
                {{ endpoint.location }}
            </Link>
        </td>
        <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
            {{ endpoint.frequency_label }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template>

            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template>
                <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium">

                </span>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template>
                %
            </template>
        </td>
        <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
            <button class="text-indigo-600 hover:text-indigo-900">
                Edit
            </button>
        </td>
        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
            <button class="text-red-600 hover:text-red-900">
                Delete
            </button>
        </td>
    </tr>
</template>

<script setup>
    import TextInput from '@/Components/TextInput.vue'
    import InputLabel from '@/Components/InputLabel.vue'
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        endpoint: Object
    })

</script>
