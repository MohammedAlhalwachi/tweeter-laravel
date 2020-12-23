<template>
    <div class="overflow-hidden relative w-10 h-10 rounded-full">
        <img class="absolute z-0" :src="src" :alt="name"/>
        <div class="absolute inset-0 rounded-full shadow-inner"></div>
    </div>
</template>
<script>
    export default {
        name: 'avatar-img',
        props: ['src', 'name'],
    }
</script>
