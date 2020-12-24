<template>
    <div>
        <Tweet v-for="tweet in tweets" v-bind="tweet"/>
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
