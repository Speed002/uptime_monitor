<template>
    <tr>
        <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
            <template v-if="editting">
                <TextInput id="location" type="text" v-model="editForm.location" class="block w-full h-9 text-sm" placeholder="eg. /Pricing"/>
            </template>
            <template v-else>
                <Link :href="route('endpoint.index', endpoint.id)" class="text-indigo-600 hover:text-indigo-900">
                    {{ endpoint.location }}
                </Link>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
            <template v-if="editting">
                <select name="frequency" v-model="editForm.frequency" id="frequency" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm">
                    <option :value="frequency.frequency" v-for="frequency in page.props.endpointFrequencies.data" :key="frequency.frequency">{{ frequency.label }}</option>
                </select>
            </template>
            <template v-else>
                {{ endpoint.frequency_label }}
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="endpoint.latest_check">
                <time datetime="endpoint.latest_check.created_at.human" :title="endpoint.latest_check.created_at.human">{{ endpoint.latest_check.create_at.human }}</time>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="endpoint.latest_check">
                <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium" :class="{'bg-green-100 text-green-800': endpoint.latest_check.is_successful, 'bg-red-100 text-red-800':!endpoint.latest_check.is_successful}">
                    {{ endpoint.latest_check.response_code }} {{ endpoint.latest_check.status_text }}
                </span>
            </template>
            <template v-else>
                -
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template>
                %
            </template>
        </td>
        <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
            <button v-on:click="editting = !editting" class="text-indigo-600 hover:text-indigo-900">
                {{ editting ? 'Done' : 'Edit' }}
            </button>
        </td>
        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
            <button v-on:click="destroyEndpoint" class="text-red-600 hover:text-red-900">
                Delete
            </button>
        </td>
    </tr>
</template>

<script setup>
    import TextInput from '@/Components/TextInput.vue'
    import InputLabel from '@/Components/InputLabel.vue'
    import { Link, router, useForm, usePage } from '@inertiajs/vue3';
    import { ref, watch } from 'vue';
    import debounce from 'lodash.debounce';

    const props = defineProps({
        endpoint: Object
    })

    const page = usePage()

    const editting = ref(false)

    const editForm = useForm({
        location:props.endpoint.location,
        frequency:props.endpoint.frequency_value //value passed down from the resource
    })

    //using debounce to delay some activity
    const editEndpoint = debounce(() => {
        editForm.patch(route('edit.endpoint', props.endpoint.id), {
            preserveScroll:true
        })
    }, 500) //debouncing at 500 ms is enough to update data

    watch(() => editForm.isDirty, () => {
        //this calls the function that has been debounced
        //it is good to seperate functions debounced from those that are not debounced
        editEndpoint()

    })

    const destroyEndpoint = () => {
        if(window.confirm){
        //router is used when we are not using a form
            router.delete(route('destroy.endpoint', props.endpoint.id))
        }
    }

</script>
