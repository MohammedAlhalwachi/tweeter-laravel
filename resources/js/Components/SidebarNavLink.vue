<template>
    <li class="p-2 py-3 ml-8" :class="classes" :active="active">
        <inertia-link :href="href">
            <slot></slot>
        </inertia-link>
    </li>
</template>
<script>
    export default {
        name: 'SidebarNavLink',
        props: ['href', 'active'],
        computed: {
            classes() {
                return this.active ? 'font-bold text-blue-500 active' : 'font-semibold text-gray-600 hover:text-gray-800';
            }
        },
    }
</script>
<style scope>
    li:hover:after {
        content: '';
        @apply absolute left-0 block bg-gray-300 w-1.5 h-10 -my-8 rounded-r-md
    }
    
    li.active:after {
        content: '';
        @apply absolute left-0 block bg-blue-500 w-1.5 h-10 -my-8 rounded-r-md
    }
</style>
