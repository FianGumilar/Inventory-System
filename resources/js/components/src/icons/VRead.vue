<script setup>
import { bool } from 'vue-types'

const props = defineProps({
    isActive: bool().def(false)
})
</script>

<template>
    <font-awesome-icon icon="fa-solid fa-eye" class="w-5 h-5 text-green-400" :class="isActive && '!text-blue-500'"/>
</template>
 