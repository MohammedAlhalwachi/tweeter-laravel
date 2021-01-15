<template>
    <div class="container flex py-8 mx-auto md:space-x-4 max-w-7xl sm:p-4">
        <aside class="hidden md:block w-1/4">
            <tweets-filter-nav :links="filterLinks" />
        </aside>

        <div class="w-full md:w-3/4 space-y-6 md:space-y-0">
            <tweets-filter-nav class="md:hidden" :links="filterLinks" />

            <TweetsList :tweets="timeline" />
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
        props: ['timeline'],
        metaInfo() {
            return {
                title: 'Bookmarks - Tweeter',
            }
        },
        data() {
            return {
                filterLinks: [
                    {
                        route: route('bookmarks.show'),
                        active: route().current('bookmarks.show', {filter: null}),
                        name: 'Tweets',
                    },
                    {
                        route: route('bookmarks.show', {filter: 'media'}),
                        active: route().current('bookmarks.show', {filter: 'media'}),
                        name: 'Media',
                    },
                ],
            }
        },
    }
</script>

<style scoped>

</style>
