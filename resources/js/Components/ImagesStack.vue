<template>
    <div class="grid overflow-hidden grid-cols-2 grid-rows-2 gap-1 mt-4 h-64 rounded-2xl border md:h-72">
        <div v-for="(image, index) in imagesWithClasses" class="relative select-none cursor-pointer" :class="image.classes">
            <img :key="index" @click="showImageViewer(index)"
                 class="object-cover w-full h-full" :src="image.src" alt="image"/>
            
            <div class="absolute top-2 left-2 text-white" @click="$emit('delete', index)" v-if="canDelete">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
            </div>
        </div>

        <image-viewer :show="isImageViewerShown" :startIndex="imageViewerStartIndex" :sources="imageSources" @close="closeImageViewer"></image-viewer>
    </div>
</template>
<script>
    import ImageViewer from "@/Components/ImageViewer"

    export default {
        name: 'images-stack',
        props: {
            imageSources: {
                type: Array,
                default: [],
            },
            withImageViewer: {
                type: Boolean,
                default: true,
            },
            canDelete: {
                type: Boolean,
                default: false,
            },
        },
        components: {ImageViewer},
        data() {
            return {
                isImageViewerShown: false,
                imageViewerStartIndex: 0,
            }
        },
        computed: {
            imagesWithClasses() {
                let imagesTemplates = [
                    [],
                    [
                        {
                            src: this.imageSources[0],
                            classes: 'row-span-2 col-span-2'
                        }
                    ],
                    [
                        {
                            src: this.imageSources[0],
                            classes: 'row-span-2'
                        },
                        {
                            src: this.imageSources[1],
                            classes: 'row-span-2'
                        }
                    ],
                    [
                        {
                            src: this.imageSources[0],
                            classes: 'row-span-2'
                        },
                        {
                            src: this.imageSources[1],
                            classes: ''
                        },
                        {
                            src: this.imageSources[2],
                            classes: ''
                        }
                    ],
                    [
                        {
                            src: this.imageSources[0],
                            classes: ''
                        },
                        {
                            src: this.imageSources[1],
                            classes: ''
                        },
                        {
                            src: this.imageSources[2],
                            classes: ''
                        },
                        {
                            src: this.imageSources[3],
                            classes: ''
                        }
                    ],
                ];

                return imagesTemplates[this.imageSources.length];
            }
        },
        methods: {
            showImageViewer(index) {
                this.imageViewerStartIndex = index;
                this.isImageViewerShown = true
            },
            closeImageViewer(){
                this.isImageViewerShown = false;
            }
        },
    }
</script>
