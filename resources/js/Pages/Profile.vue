<template>
    <div>
        <header>
            <!--<div class="w-full h-64 bg-fixed bg-center bg-no-repeat bg-cover" :style="`background-image: url('${$page.props.user.profile_banner_url}')`"></div>-->
            <img class="object-cover object-center w-full h-64" :src="$page.props.profile_user.profile_banner_url"
                 alt="profile banner">

            <div class="container relative z-20 mx-auto -mt-16 max-w-7xl sm:p-4">
                <div class="flex flex-col justify-center items-center p-5 space-y-5 bg-white rounded-md shadow md:items-start md:flex-row md:justify-between md:space-y-0">
                    <div class="flex flex-col justify-center items-center space-y-5 md:items-start md:flex-row md:space-y-0">
                        <div class="flex-shrink-0 -mt-16 w-32 h-32 bg-white rounded-md border-4 border-white md:w-40 md:h-40">
                            <img class="object-cover w-full h-full rounded-md" :src="$page.props.profile_user.profile_photo_url" alt="profile avatar">
                        </div>
                        <div class="space-y-5 md:ml-8">
                            <div class="flex flex-col justify-center justify-between items-center mr-4 md:flex-row md:flex-wrap">
                                <h1 class="text-2xl font-bold tracking-tight text-gray-800">{{ $page.props.profile_user.name }}</h1>

                                <div class="">
                                <span>
                                    <span class="font-bold">{{ $page.props.profile_user.followings_count }}</span>
                                    <span class="ml-1 text-sm font-semibold text-gray-600">Following</span>
                                </span>
                                    <span>
                                    <span class="ml-4 font-bold">{{ $page.props.profile_user.followers_count }}</span>
                                    <span class="ml-1 text-sm font-semibold text-gray-600">Followers</span>
                                </span>
                                </div>
                            </div>
                            <p class="max-w-xl text-center text-gray-700 md:text-left">{{ $page.props.profile_user.description }}</p>
                        </div>
                    </div>
                    <div>
                        <inertia-link :href="route('settings.show')" v-if="$page.props.user.id === $page.props.profile_user.id">
                            <v-button>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                                <span class="ml-2">Settings</span>
                            </v-button>
                        </inertia-link>
                        <template v-else>
                            <v-button @click.native="follow($page.props.profile_user.id)" v-if="!$page.props.profile_user.is_followed">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                                <span class="ml-2">Follow</span>
                            </v-button>
                            <v-button @click.native="unfollow($page.props.profile_user.id)" v-else>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path></svg>
                                <span class="ml-2">Unfollow</span>
                            </v-button>
                        </template>
                    </div>
                </div>
            </div>
        </header>

        <div class="container flex flex-col py-8 mx-auto space-y-2 max-w-7xl md:flex-row md:space-y-0 md:space-x-4 sm:p-4">
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
                        route: route('profile.show', {username: this.$page.props.user.username}),
                        active: route().current('profile.show', {filter: null}),
                        name: 'Tweets',
                    },
                    {
                        route: route('profile.show', {username: this.$page.props.user.username, filter: 'media'}),
                        active: route().current('profile.show', {filter: 'media'}),
                        name: 'Media',
                    },
                    {
                        route: route('profile.show', {username: this.$page.props.user.username, filter: 'likes'}),
                        active: route().current('profile.show', {filter: 'likes'}),
                        name: 'Likes',
                    },
                ],
            }
        },
        methods: {
            follow() {
                this.$inertia.post(route('profile.followings.store', {id: this.$page.props.profile_user.id}));
            },
            unfollow() {
                this.$inertia.delete(route('profile.followings.destroy', {id: this.$page.props.profile_user.id}));
            }
        },
    }
</script>

<style scoped>

</style>
