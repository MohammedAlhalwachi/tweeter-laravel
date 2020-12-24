<template>
    <button :type="type" :class="classes" class="inline-flex items-center font-semibold tracking-widest text-white bg-blue-500 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray">
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
                    'py-2 px-6 text-sm': this.size === 'normal',
                    'py-2 px-4 text-xs': this.size === 'small',
                };
            }
        },
    }
</script>
