<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
        <div class="p-4 sm:p-6">
            <header class="font-bold text-gray-700">
                <slot name="header"></slot>
            </header>

            <div class="my-4 -mx-4 sm:-mx-6 border-t-2 border-gray-100"></div>

            <slot></slot>
        </div>

        <div class="flex justify-between items-center p-3 py-2 mt-2 bg-gray-50" v-if="hasActions">
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Card",
        computed: {
            hasActions() {
                return !!this.$slots.actions;
            }
        },
    }
</script>

<style scoped>

</style>
