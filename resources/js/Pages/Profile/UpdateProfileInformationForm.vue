<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" alt="Current Profile Photo" class="object-cover w-20 h-20 rounded-full">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block w-20 h-20 rounded-full"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="user.profile_photo_path">
                    Remove Photo
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Profile Banner -->
            <div class="col-span-6 sm:col-span-4">
                <!-- Profile Banner File Input -->
                <input type="file" class="hidden"
                       ref="banner"
                       @change="updateBannerPreview">

                <jet-label for="banner" value="Banner" />

                <!-- Current Profile Banner -->
                <div class="mt-2" v-show="! bannerPreview">
                    <img :src="user.profile_banner_url" alt="Current Profile Banner" class="object-cover w-full h-36 rounded-md">
                </div>

                <!-- New Profile Banner Preview -->
                <div class="mt-2" v-show="bannerPreview">
                    <span class="block w-full h-36 rounded-md"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + bannerPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewBanner">
                    Select A New Banner
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deleteBanner" v-if="user.profile_banner_path">
                    Remove Banner
                </jet-secondary-button>

                <jet-input-error :message="form.errors.banner" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="block mt-1 w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="description" value="Description" />
                <textarea id="description" type="text" class="form-input rounded-md shadow-sm block mt-1 w-full" rows="4" v-model="form.description"></textarea>
                <jet-input-error :message="form.errors.description" class="mt-2" />
            </div>

            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="username" value="Username" />
                <jet-input id="username" type="text" class="block mt-1 w-full" v-model="form.username" />
                <jet-input-error :message="form.errors.username" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="block mt-1 w-full" v-model="form.email" autocomplete="email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    name: this.user.name,
                    description: this.user.description,
                    username: this.user.username,
                    email: this.user.email,
                    photo: null,
                    banner: null,
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
                bannerPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0] || null;
                }

                if (this.$refs.banner) {
                    this.form.banner = this.$refs.banner.files[0] || null;
                }

                this.form.post(route('user-profile-information.update'), {
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            selectNewBanner() {
                this.$refs.banner.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },
            
            updateBannerPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.bannerPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.banner.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                }).then(() => {
                    this.photoPreview = null
                    // Empty the file input
                    this.$refs.photo.value = '';
                });
            },

            deleteBanner() {
                this.$inertia.delete(route('current-user-banner.destroy'), {
                    preserveScroll: true,
                }).then(() => {
                    this.bannerPreview = null
                    // Empty the file input
                    this.$refs.banner.value = '';
                });
            },
        },
    }
</script>
