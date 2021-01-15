<template>
    <div v-if="tweets.length > 0">
        <Tweet v-for="tweet in tweets" :key="tweet.unique_id || tweet.id" v-bind="tweet"/>
    </div>
    <div v-else>
        <slot name="emptyList">
            <div class="flex flex-col justify-center items-center mt-8 text-2xl font-semibold text-center text-gray-800">
                <p class="text-3xl font-medium">
                    No tweets 😅!
                </p>
            </div>
        </slot>
    </div>
</template>
<script>
    import Tweet from "@/Components/Tweet"

    export default {
        name: 'TweetsList',
        components: {Tweet},
        props: ['tweets'],
    }
</script>
