<script setup>
import axios from "axios";
import { ref } from "vue";
import { bool, object } from "vue-types";
import { notify } from "notiwind";
import VDialog from '@/components/VDialog/index.vue';
import VButton from '@/components/VButton/index.vue';
import VInput from '@/components/VInput/index.vue';
import VSelect from '@/components/VSelect/index.vue';

const props = defineProps({
    openDialog: bool(),
    updateAction: bool().def(false),
    data: object().def({}),
    additional: object().def({})
})

const emit = defineEmits(['close', 'successSubmit'])

const typeOptions = ref({
    'Sudah': 'Sudah',
    'Belum': 'Belum',
})

const isLoading = ref(false);
const formError = ref({})
const form = ref({})
const previewImage = ref('')

const openForm = () => {
    if (props.updateAction) {
        form.value = Object.assign(form.value, props.data)
    } else {
        form.value = ref({})
    }
}

const closeForm = () => {
    form.value = ref({})
    formError.value = ref({})
}

const submit = async () => {
    props.updateAction ? update() : create()
}

const update = async () => {
    isLoading.value = true
    axios.post(route('book.update', { 'id': props.data.id }), form.value)
        .then((res) => {
            emit('close')
            emit('successSubmit')
            form.value = ref({})
            notify({
                type: "success",
                group: "top",
                text: res.data.meta.message
            }, 2500)
        }).catch((res) => {
            // Handle validation errors
            const result = res.response.data
            const metaError = res.response.data.meta?.error
            if (result.hasOwnProperty('errors')) {
                formError.value = ref({});
                Object.keys(result.errors).map((key) => {
                    formError.value[key] = result.errors[key].toString();
                });
            }

            if (metaError) {
                notify({
                    type: "error",
                    group: "top",
                    text: metaError
                }, 2500)
            } else {
                notify({
                    type: "error",
                    group: "top",
                    text: result.message
                }, 2500)
            }
        }).finally(() => isLoading.value = false)
}

const create = async () => {
    isLoading.value = true
    axios.post(route('book.create'), form.value)
        .then((res) => {
            emit('close')
            emit('successSubmit')
            form.value = ref({})
            notify({
                type: "success",
                group: "top",
                text: res.data.meta.message
            }, 2500)
        }).catch((res) => {
            // Handle validation errors
            const result = res.response.data
            const metaError = res.response.data.meta?.error
            if (result.hasOwnProperty('errors')) {
                formError.value = ref({});
                Object.keys(result.errors).map((key) => {
                    formError.value[key] = result.errors[key].toString();
                });
            }

            if (metaError) {
                notify({
                    type: "error",
                    group: "top",
                    text: metaError
                }, 2500)
            } else {
                notify({
                    type: "error",
                    group: "top",
                    text: result.message
                }, 2500)
            }
        }).finally(() => isLoading.value = false)
}
</script>

<template>
    <VDialog :showModal="openDialog" :title="updateAction ? 'Update Book' : 'Create Book'" @opened="openForm" @closed="closeForm" size="xl">
        <template v-slot:close>
            <button class="text-slate-400 hover:text-slate-500" @click="$emit('close')">
                <div class="sr-only">Close</div>
                <svg class="w-4 h-4 fill-current">
                    <path
                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                </svg>
            </button>
        </template>
        <template v-slot:content>
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <VInput placeholder="Insert Book Title" label="Book Title" :required="true" v-model="form.book_title" :errorMessage="formError.book_title"
                        @update:modelValue="formError.book_title = ''" />
                </div>
                <div class="col-span-2">
                    <VInput placeholder="Insert Book Number" label="Book Number" :required="true" v-model="form.book_number" :errorMessage="formError.book_number"
                        @update:modelValue="formError.book_number = ''" />
                </div>
                <div class="col-span-2">
                    <VInput placeholder="Insert Book Location" label="Book Location" :required="true" v-model="form.location" :errorMessage="formError.location"
                        @update:modelValue="formError.location = ''" />
                </div>
                <div class="col-span-2">
                    <VInput placeholder="Insert File Path" label="File Path" :required="true" v-model="form.file_path" :errorMessage="formError.file_path"
                        @update:modelValue="formError.file_path = ''" />
                </div>
                <div class="col-span-2">
                    <VSelect placeholder="Scan Status" label="Scan" :required="true" v-model="form.is_scan" :options="typeOptions"
                    :errorMessage="formError.is_scan" @update:modelValue="formError.is_scan = ''" ref="typeSelectHandle" />
                </div>
                <div class="col-span-2">
                    <VSelect placeholder="Choose Departemen" :required="true" v-model="form.category_id"
                        :options="additional.category_list" label="Departemen" :errorMessage="formError.category_id"
                        @update:modelValue="formError.category_id = ''" />
                </div>
                <div class="col-span-2">
                    <VSelect placeholder="Choose Fungsi" :required="true" v-model="form.utility_id"
                        :options="additional.utility_list" label="Fungsi" :errorMessage="formError.utility_id"
                        @update:modelValue="formError.utility_id = ''" />
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <div class="flex flex-wrap justify-end space-x-2">
                <VButton label="Cancel" type="default" @click="$emit('close')" />
                <VButton :is-loading="isLoading" :label="updateAction ? 'Update' : 'Create'" type="primary" @click="submit" />
            </div>
        </template>
    </VDialog>
</template>
