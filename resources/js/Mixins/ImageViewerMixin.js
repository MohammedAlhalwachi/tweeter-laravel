export default {
    data(){
        return {
            viewImageSrc: undefined,
        };
    },
    computed: {
        isImageViewerShown(){
            return this.viewImageSrc !== undefined;
        },
    },
    methods: {
        showImageViewer(src){
            this.viewImageSrc = src;
        },
        closeImageViewer(){
            this.viewImageSrc = undefined;
        },
    },
};
