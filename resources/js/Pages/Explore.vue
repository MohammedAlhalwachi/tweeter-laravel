<template>
    <div class="container flex py-8 mx-auto max-w-7xl md:space-x-4 sm:p-4">
        <aside class="hidden w-1/4 md:block">
            <tweets-filter-nav :links="filterLinks" />
        </aside>

        <div class="space-y-6 w-full md:w-3/4">
            <form @submit.prevent="submitSearch" class="flex relative items-center w-full">
                <label for="search-explore" class="sr-only">Search</label>
                <div class="flex absolute left-0 items-center ml-4 text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input id="search-explore" v-model="form.searchQuery" type="text" class="py-3 pr-24 pl-12 w-full bg-white border-0 shadow sm:rounded-md">
                <v-button size="small" class="absolute right-0 mr-2">Search</v-button>
            </form>

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
        name: "Explore",
        components: {VButton, Label, TweetsFilterNav, TweetsList, AppLayout},
        layout: AppLayout,
        props: ['timeline', 'searchQuery'],
        metaInfo() {
            return {
                title: 'Explore - Tweeter',
            }
        },
        data() {
            return {
                form: this.$inertia.form({
                    searchQuery: this.searchQuery,
                }),
                filterLinks: [
                    {
                        route: route('explore.top.show'),
                        active: route().current('explore.top.show'),
                        name: 'Top',
                    },
                    {
                        route: route('explore.latest.show'),
                        active: route().current('explore.latest.show'),
                        name: 'Latest',
                    },
                    // {
                    //     route: route('explore.people.show'),
                    //     active: route().current('explore.people.show'),
                    //     name: 'People',
                    // },
                    {
                        route: route('explore.media.show'),
                        active: route().current('explore.media.show'),
                        name: 'Media',
                    },
                ],
            }
        },
        methods: {
            submitSearch() {
                this.form.submit('get', this.route(route().current(), {
                    q: this.form.searchQuery
                }))
            }
        },
    }
</script>

<style scoped>

</style>
