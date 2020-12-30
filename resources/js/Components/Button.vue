<template>
    <button :type="type" :class="classes" class="inline-flex items-center font-semibold tracking-widest text-white bg-blue-500 rounded-md border-0 border-transparent transition duration-150 ease-in-out hover:bg-blue-600 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
            size: {
                type: String,
                default: 'normal'
            }
        },
        computed: {
            classes() {
                return {
                    'py-1.5 px-5 text-sm': this.size === 'normal',
                    'py-1.5 px-4 text-xs': this.size === 'small',
                };
            }
        },
    }
</script>
