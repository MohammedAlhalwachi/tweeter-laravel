<template>
    <div class="container flex py-8 mx-auto space-x-2 space-x-4 max-w-7xl sm:p-4">
        <div class="w-full md:w-3/4">
            <tweet-form />
            
            <div class="mt-8">
                <TweetsList :tweets="timeline"  v-if="timeline.length > 0"/>
                <div class="flex flex flex-col justify-center items-center text-2xl font-semibold text-center text-gray-800 mt-24" v-else>
                    <span class="text-6xl">😃</span>
                    <span class="mt-8 text-3xl">Welcome</span>
                    <p class="text-xl font-medium mt-8">
                        No tweets yet!
                        <br>
                        Try following new people
                    </p>
                </div>
            </div>
        </div>

        <aside class="hidden w-1/4 md:block">
            <trends-sidebar-section />
        </aside>
    </div>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import TweetForm from "@/Components/TweetForm";
    import TrendsSidebarSection from "@/Components/TrendsSidebarSection";
    import TweetsList from "@/Components/TweetsList";

    export default {
        name: "Home",
        components: {TweetsList, TrendsSidebarSection, TweetForm},
        layout: AppLayout,
        props: ['timeline'],
        metaInfo() {
            return {
                title: 'Home - Tweeter',
            }
        },
        data() {
            return {
            }
        },
    }
</script>

