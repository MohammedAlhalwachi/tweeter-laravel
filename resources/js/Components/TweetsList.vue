<template>
    <div>
        <Tweet v-for="tweet in tweets" :key="tweet.unique_id || tweet.id" v-bind="tweet"/>
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
