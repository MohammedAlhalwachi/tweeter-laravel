<template>
    <v-card>
        <template #header>
            Tweet something
        </template>
        
        <div class="flex">
            <current-user-avatar />
            <div class="pl-3 w-full">
                <textarea name="tweet"
                          class="w-full rounded border-0 focus:bg-gray-50 focus:ring-0 focus:border-black"
                          rows="5" placeholder="What's happening?"
                          v-model="form.body"
                ></textarea>
                <div class="flex flex-row-reverse">
                    <span class="flex-shrink-0 ml-5 text-xs" :class="bodyWordsCountClasses">{{ form.body.length }} / 280</span>
                </div>
                <images-stack :image-sources="imagesPreview" v-if="imagesPreview.length !== 0" />
                <button class="py-2 px-3 text-sm font-semibold text-gray-500" @click="removeImages" v-if="imagesPreview.length !== 0">Remove images</button>
                <div>
                    <p class="ml-3 text-xs text-red-500">{{ form.errors.body }}</p>
                    <p class="ml-3 text-xs text-red-500">{{ form.errors.images }}</p>
                    <p class="ml-3 text-xs text-red-500">{{ imagesError }}</p>
                </div>
            </div>
        </div>
        
        <template #actions>
            <div class="flex items-center text-blue-500">
                <button @click="$refs.images.click()">
                    <input type="file" class="hidden"
                           ref="images"
                           @change="updateImagesPreview"
                           multiple>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                </button>
                <!--<button class="flex items-center ml-4 text-sm font-semibold tracking-tight">-->
                <!--    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>-->
                <!--    <span class="ml-2">Everyone can reply</span>-->
                <!--</button>-->
            </div>

            <v-button @click.native="postTweet" :disabled="form.processing">Tweet</v-button>
        </template>
    </v-card>
</template>
<script>
    import CurrentUserAvatar from "@/Components/CurrentUserAvatar"
    import VButton from '@/Components/Button'
    import VCard from '@/Components/Card'
    import ImagesStack from "@/Components/ImagesStack";
    import Button from "@/Jetstream/Button";

    export default {
        name: 'tweet-form',
        components: {Button, ImagesStack, CurrentUserAvatar, VButton, VCard},
        data() {
            return {
                form: this.$inertia.form({
                    body: '',
                    images: [],
                    // errorBag: 'postTweet'
                // }, {
                //     bag: 'postTweet',
                }),

                imagesPreview: [],
                imagesError: '',
            }
        },
        computed: {
            bodyWordsCountClasses() {
                if (this.form.body.length === 0)
                    return 'text-gray-600';
                else if (this.form.body.length <= 280)
                    return 'text-green-500';
                else
                    return 'text-red-500';
            }
        },
        methods: {
            postTweet() {
                this.form.images = this.$refs.images.files.length === 0 ? [] : this.$refs.images.files;

                this.form.post(route('tweets.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        if (Object.keys(this.$page.props.errors).length === 0) {
                            this.imagesPreview = [];
                        }
                    },
                });
            },

            updateImagesPreview() {
                for (const file of this.$refs.images.files){
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (this.imagesPreview.length === 4) {
                            this.imagesError = 'You may not have more than 4 images.';

                            setTimeout(() => {
                                this.imagesError = '';
                            }, 2500);
                        } else {
                            this.imagesPreview.push(e.target.result);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeImages() {
                this.$refs.images.value = '';
                this.imagesPreview = [];
            }
        },
    }
</script>
