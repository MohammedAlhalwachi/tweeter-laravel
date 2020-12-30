<template>
    <li>
        <inertia-link :class="classes" :href="href" class="link block p-2 py-3 pl-8 w-full hover:bg-gray-50" :active="active">
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
<style scoped>
    .link:hover:after {
        content: '';
        @apply absolute left-0 block bg-gray-300 w-1.5 h-10 -my-8 rounded-r-md;
    }

    .link.active:after {
        content: '';
        @apply absolute left-0 block bg-blue-500 w-1.5 h-10 -my-8 rounded-r-md;
    }
</style>
