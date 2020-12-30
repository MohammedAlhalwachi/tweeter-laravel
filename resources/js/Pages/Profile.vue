<template>
    <div>
        <header>
            <!--<div class="w-full h-64 bg-fixed bg-center bg-no-repeat bg-cover" :style="`background-image: url('${$page.props.user.profile_banner_url}')`"></div>-->
            <img class="object-cover object-center w-full h-64" :src="$page.props.user.profile_banner_url"
                 alt="profile banner">

            <div class="container mx-auto max-w-7xl sm:p-4 -mt-16 relative z-20">
                <div class="flex flex-col justify-center items-center md:items-start md:flex-row p-5 bg-white rounded-md shadow space-y-5 md:space-y-0">
                    <div class="-mt-16 w-32 h-32 md:w-40 md:h-40 flex-shrink-0 bg-white rounded-md border-4 border-white">
                        <img class="object-cover w-full h-full rounded-md" :src="$page.props.user.profile_photo_url" alt="profile avatar">
                    </div>
                    <div class="md:ml-8 space-y-5">
                        <div class="flex flex-col justify-center items-center md:flex-row mr-4 md:flex-wrap justify-between">
                            <h1 class="text-2xl font-bold tracking-tight text-gray-800">{{ $page.props.user.name }}</h1>

                            <div class="">
                                <span>
                                    <span class="font-bold">2,568</span>
                                    <span class="ml-1 text-sm font-semibold text-gray-600">Following</span>
                                </span>
                                <span>
                                    <span class="ml-4 font-bold">10.8K</span>
                                    <span class="ml-1 text-sm font-semibold text-gray-600">Followers</span>
                                </span>
                            </div>
                        </div>
                        <p class="max-w-xl text-gray-700 text-center md:text-left">{{ $page.props.user.description }}</p>
                    </div>
                    <div class="md:ml-auto">
                        <v-button>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                            </svg>
                            <span class="ml-2">Follow</span>
                        </v-button>
                    </div>
                </div>
            </div>
        </header>

        <div class="container flex flex-col md:flex-row py-8 mx-auto max-w-7xl space-y-2 md:space-y-0 md:space-x-4 sm:p-4">
            <aside class="md:w-1/4">
                <tweets-filter-nav :links="filterLinks"/>
            </aside>

            <main class="space-y-6 w-full md:w-3/4 md:space-y-0">
                <TweetsList :tweets="timeline"/>
            </main>
        </div>
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import TweetsList from '@/Components/TweetsList'
    import TweetsFilterNav from "@/Components/TweetsFilterNav";
    import Label from "@/Jetstream/Label";
    import VButton from "@/Components/Button";

    export default {
        name: "Profile",
        components: {VButton, Label, TweetsFilterNav, TweetsList, AppLayout},
        layout: AppLayout,
        props: ['timeline'],
        metaInfo() {
            return {
                title: `${this.$page.props.user.name} (@${this.$page.props.user.username}) - Tweeter`,
            }
        },
        data() {
            return {
                filterLinks: [
                    {
                        route: route('profile.tweets', {username: this.$page.props.user.username}),
                        active: route().current('profile.tweets'),
                        name: 'Tweets',
                    },
                    {
                        route: route('profile.media', {username: this.$page.props.user.username}),
                        active: route().current('profile.media'),
                        name: 'Media',
                    },
                    {
                        route: route('profile.likes', {username: this.$page.props.user.username}),
                        active: route().current('profile.likes'),
                        name: 'Likes',
                    },
                ],
            }
        },
    }
</script>

<style scoped>

</style>
