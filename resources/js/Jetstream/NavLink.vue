<template>
    <inertia-link @focus="focus = true" @blur="focus = false" @mouseover='hover = true' @mouseout="hover = false" :class="classes" :href="href" class="flex relative items-center px-1 pt-1 text-sm leading-5 text-gray-500 select-none focus:outline-none">
        <slot></slot>
        <div class="block absolute inset-x-0 bottom-0 -mx-2 h-1 rounded-t-md transition duration-150 ease-in-out" :class="barClasses"></div>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],
        data() {
            return {
                hover: false,
                focus: false,
            }
        },
        computed: {
            classes() {
                return this.active ? 'text-blue-500' : 'hover:text-gray-700';
            },
            barClasses() {
                let classes = [];
                if(this.active)
                    classes += 'bg-blue-500';
                else if (this.focus)
                    classes += 'bg-gray-300';
                else if (this.hover)
                    classes += 'bg-gray-200';

                return classes;
            }
        },
    }
</script>
