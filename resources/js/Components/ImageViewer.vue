<template>
    <portal to="imageViewer">
        <transition enter-active-class="duration-200"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="duration-75"
                    leave-class="opacity-100"
                    leave-to-class="opacity-0">
            <div v-show="show" class="fixed inset-0 bg-black bg-opacity-90">
                <button class="absolute top-2 left-2 z-20 p-3 text-gray-100 rounded-full transition duration-150 ease-in-out focus:outline-none hover:bg-black hover:bg-opacity-70 focus:bg-opacity-70 focus:bg-gray-800" @click="$emit('close')">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

                <img class="object-contain w-full h-full" :key="currentSrcIndex" :src="currentSrc" alt="image">

                <div class="flex absolute inset-y-0 left-0 z-10 items-center sm:left-3">
                    <transition enter-active-class="duration-200"
                                enter-class="opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="duration-75"
                                leave-class="opacity-100"
                                leave-to-class="opacity-0">
                        <button v-if="!isFirstImg" @click="prev()" class="p-1 text-gray-100 bg-black bg-opacity-40 rounded-full transition duration-150 ease-in-out focus:outline-none hover:bg-black hover:bg-opacity-70 focus:bg-gray-800">
                            <svg class="w-8 h-8 sm:w-14 sm:h-14" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </button>
                    </transition>
                </div>
                <div class="flex absolute inset-y-0 right-0 z-10 items-center sm:right-3">
                    <transition enter-active-class="duration-200"
                                enter-class="opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="duration-75"
                                leave-class="opacity-100"
                                leave-to-class="opacity-0">
                        <button v-if="!isLastImg" @click="next()" class="p-1 text-gray-100 bg-black bg-opacity-40 rounded-full transition duration-150 ease-in-out focus:outline-none hover:bg-black hover:bg-opacity-70 focus:bg-opacity-70 focus:bg-gray-800">
                            <svg class="w-8 h-8 sm:w-14 sm:h-14" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </button>
                    </transition>
                </div>
            </div>
        </transition>
    </portal>
</template>

<script>
    export default {
        name: "ImageViewer",
        props: ['show', 'sources', 'startIndex'],
        data() {
            return {
                currentSrcIndex: 0,
            }
        },
        computed: {
            isFirstImg() {
                return this.currentSrcIndex === 0
            },
            isLastImg() {
                return this.currentSrcIndex === this.sources.length - 1;
            },
            currentSrc() {
                return this.sources[this.currentSrcIndex];
            }
        },
        watch: {
            startIndex() {
                this.currentSrcIndex = this.startIndex;
            },
            show: {
                immediate: true,
                handler: (show) => {
                    if (show) {
                        document.body.style.overflow = 'hidden'
                    } else {
                        document.body.style.overflow = null
                    }
                }
            }
        },
        methods: {
            next() {
                if (!this.isLastImg)
                    this.currentSrcIndex++;
            },
            prev() {
                if (!this.isFirstImg)
                    this.currentSrcIndex--;
            }
        },
    }
</script>

<style scoped>

</style>
