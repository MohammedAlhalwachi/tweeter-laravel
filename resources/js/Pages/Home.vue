<template>
    <div class="container flex py-8 mx-auto space-x-2 space-x-4 max-w-7xl sm:p-4">
        <div class="w-full md:w-7/10">
            <tweet-form />
            
            <div class="mt-8">
                <Tweet v-bind="tweet" />
                <Tweet v-bind="tweet" />
                <Tweet v-bind="tweet" />
                <Tweet v-bind="tweet" />
                <Tweet v-bind="tweet" />
            </div>
        </div>

        <sidebar class="hidden md:block w-3/10" />
    </div>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import TweetForm from "@/Components/TweetForm";
    import Sidebar from "@/Components/Sidebar";
    import Tweet from "@/Pages/Tweet";

    export default {
        name: "Home",
        components: {Tweet, Sidebar, TweetForm, AppLayout},
        layout: AppLayout,
        data() {
            return {
                tweet: {
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
            }
        },
    }
</script>

