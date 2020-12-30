<template>
    <div class="container flex py-8 mx-auto md:space-x-4 max-w-7xl sm:p-4">
        <aside class="hidden md:block w-1/4">
            <tweets-filter-nav :links="filterLinks" />
        </aside>

        <div class="w-full md:w-3/4 space-y-6 md:space-y-0">
            <tweets-filter-nav class="md:hidden" :links="filterLinks" />

            <TweetsList :tweets="tweets" />
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
        name: "Bookmarks",
        components: {VButton, Label, TweetsFilterNav, TweetsList, AppLayout},
        layout: AppLayout,
        metaInfo() {
            return {
                title: 'Bookmarks - Tweeter',
            }
        },
        data() {
            return {
                filterLinks: [
                    {
                        route: route('bookmarks.tweets'),
                        active: route().current('bookmarks.tweets'),
                        name: 'Tweets',
                    },
                    {
                        route: route('bookmarks.media'),
                        active: route().current('bookmarks.media'),
                        name: 'Media',
                    },
                    {
                        route: route('bookmarks.likes'),
                        active: route().current('bookmarks.likes'),
                        name: 'Likes',
                    },
                ],
                tweets: [
                    {
                        user: {
                            name: 'Mohammed Alhalwachi',
                        },
                        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tempor lorem a ipsum iaculis pulvinar. Nunc consectetur placerat tincidunt. Nulla facilisi. Suspendisse erat curae.',
                        images: [
                            `https://picsum.photos/1280/720`,
                            // `https://picsum.photos/500/500`,
                            `https://picsum.photos/500/500`,
                            `https://picsum.photos/450/2860`,
                        ],
                        createdAt: '',
                    },
                    {
                        user: {
                            name: 'Mohammed Alhalwachi',
                        },
                        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tempor lorem a ipsum iaculis pulvinar. Nunc consectetur placerat tincidunt. Nulla facilisi. Suspendisse erat curae.',
                        images: [
                            `https://picsum.photos/1280/720`,
                            // `https://picsum.photos/500/500`,
                            `https://picsum.photos/500/500`,
                            `https://picsum.photos/450/2860`,
                        ],
                        createdAt: '',
                    },
                    {
                        user: {
                            name: 'Mohammed Alhalwachi',
                        },
                        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tempor lorem a ipsum iaculis pulvinar. Nunc consectetur placerat tincidunt. Nulla facilisi. Suspendisse erat curae.',
                        images: [
                            `https://picsum.photos/1280/720`,
                            // `https://picsum.photos/500/500`,
                            `https://picsum.photos/500/500`,
                            `https://picsum.photos/450/2860`,
                        ],
                        createdAt: '',
                    },
                    {
                        user: {
                            name: 'Mohammed Alhalwachi',
                        },
                        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tempor lorem a ipsum iaculis pulvinar. Nunc consectetur placerat tincidunt. Nulla facilisi. Suspendisse erat curae.',
                        images: [
                            `https://picsum.photos/1280/720`,
                            // `https://picsum.photos/500/500`,
                            `https://picsum.photos/500/500`,
                            `https://picsum.photos/450/2860`,
                        ],
                        createdAt: '',
                    },
                ],
            }
        },
    }
</script>

<style scoped>

</style>
