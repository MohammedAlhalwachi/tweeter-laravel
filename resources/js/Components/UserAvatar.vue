<template>
    <div class="overflow-hidden relative w-10 h-10 rounded-full">
        <img class="object-cover absolute z-0 w-full h-full" :src="src" :alt="name"/>
        <div class="absolute inset-0 rounded-full shadow-inner"></div>
    </div>
</template>
<script>
    export default {
        name: 'avatar-img',
        props: ['src', 'name'],
    }
</script>
