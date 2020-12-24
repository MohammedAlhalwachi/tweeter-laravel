<template>
    <inertia-link :href="href" class="relative flex-1 p-2 select-none focus:outline-none" :class="[active ? 'text-blue-500' : 'text-gray-500']">
        <button class="py-2 w-full text-center rounded-md focus:outline-none" :class="[active ? '' : 'hover:bg-gray-100']">
            <slot></slot>
            <div class="block absolute inset-x-0 bottom-0 mx-6 h-1 rounded-t-md transition duration-150 ease-in-out" :class="barClasses"></div>
        </button>
    </inertia-link>
</template>
<script>
    export default {
        name: 'footer-nav-link',
        props: ['active', 'href'],
        computed: {
            barClasses() {
                if(this.active)
                    return 'bg-blue-500';
            }
        },
    }
</script>
