<template>
    <div @click="" class="overflow-hidden p-4 pb-1 mb-3 bg-white shadow transition duration-150 ease-in-out cursor-pointer sm:p-6 sm:pb-2 hover:bg-gray-50 sm:mb-0 last:sm:border-b-0 sm:border-b-2 sm:border-gray-200 sm:last:rounded-b-md sm:first:rounded-t-md">
        <!-- Header: user info -->
        <header class="text-gray-700">
            <!-- Retweeter info -->
            <div class="flex items-center mb-3 text-sm text-gray-400" v-if="retweeted_at">
                <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current"><g><path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g></svg>
                <inertia-link :href="route('profile.show', {username: retweet_user.username})" class="ml-3 hover:underline">{{ retweet_user.id === $page.props.user.id ? 'You' : retweet_user.name }} Retweeted</inertia-link>
            </div>
            
            <!-- Author info -->
            <div class="flex">
                <inertia-link class="flex" :href="route('profile.show', {username: user.username})">
                    <user-avatar :src="user.profile_photo_url" name="test"/>
                    <div class="ml-4 text-sm">
                        <span class="block font-bold">{{ user.name }}</span>
                        <span class="text-gray-400">{{ dayjs(created_at).fromNow() }}</span>
                    </div>
                </inertia-link>
            </div>
        </header>

        <!-- Separator -->
        <div class="my-4 -mx-4 border-t-2 border-gray-100 sm:-mx-6"></div>

        <!-- Body -->
        <div class="pl-14">
            <p class="max-w-xl break-words">{{ body }}</p>
            <images-stack :image-sources="images.map(image => image.url)" v-if="images.length > 0" />
        </div>

        <div class="flex justify-around items-center pl-14 mt-1 text-sm text-gray-400">
            <button @click.stop="toggleRetweet" class="flex flex-1 justify-center items-center py-2 rounded-md transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none hover:text-green-500" :class="{'text-green-500': is_retweeted}">
                <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current"><g><path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g></svg>
                <span class="mt-1 ml-1">{{ retweets_count || '' }}</span>
            </button>
            <button @click.stop="toggleLike" class="flex flex-1 justify-center items-center py-2 rounded-md transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none hover:text-pink-500" :class="{'text-pink-500': is_liked}">
                <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current"><g><path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path></g></svg>
                <span class="mt-1 ml-1">{{ likes_count || '' }}</span>
            </button>
            <button @click.stop="toggleBookmark" class="flex flex-1 justify-center items-center py-2 rounded-md transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none hover:text-blue-500" :class="{'text-blue-500': is_bookmarked}">
                <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current"><g><path d="M19.9 23.5c-.157 0-.312-.05-.442-.144L12 17.928l-7.458 5.43c-.228.164-.53.19-.782.06-.25-.127-.41-.385-.41-.667V5.6c0-1.24 1.01-2.25 2.25-2.25h12.798c1.24 0 2.25 1.01 2.25 2.25v17.15c0 .282-.158.54-.41.668-.106.055-.223.082-.34.082zM12 16.25c.155 0 .31.048.44.144l6.71 4.883V5.6c0-.412-.337-.75-.75-.75H5.6c-.413 0-.75.338-.75.75v15.677l6.71-4.883c.13-.096.285-.144.44-.144z"></path></g></svg>
                <span class="mt-1 ml-1">{{ bookmarks_count || '' }}</span>
            </button>
        </div>
        
    </div>
</template>
<script>
    import * as dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    dayjs.extend(relativeTime);

    import UserAvatar from "@/Components/UserAvatar";
    import ImagesStack from "@/Components/ImagesStack";

    export default {
        name: 'Tweet',
        components: {ImagesStack, UserAvatar},
        props: ['id', 'body', 'user', 'images', 'likes_count', 'retweets_count', 'bookmarks_count', 'is_retweeted', 'is_liked', 'is_bookmarked', 'retweet_user', 'created_at', 'retweeted_at'],
        data() {
            return {}
        },
        computed: {
        },
        methods: {
            dayjs: dayjs,
            like() {
                this.$inertia.post(route('tweets.likes.store', {id: this.id}), {}, {
                    preserveScroll: true,
                });
            },
            unlike() {
                this.$inertia.delete(route('tweets.likes.destroy', {id: this.id}), {
                    preserveScroll: true,
                });
            },
            toggleLike(){
                this.is_liked ? this.unlike() : this.like();
            },
            retweet() {
                this.$inertia.post(route('tweets.retweets.store', {id: this.id}), {}, {
                    preserveScroll: true,
                });
            },
            unretweet() {
                this.$inertia.delete(route('tweets.retweets.destroy', {id: this.id}), {
                    preserveScroll: true,
                });
            },
            toggleRetweet(){
                this.is_retweeted ? this.unretweet() : this.retweet();
            },
            bookmark() {
                this.$inertia.post(route('tweets.bookmarks.store', {id: this.id}), {}, {
                    preserveScroll: true,
                });
            },
            unbookmark() {
                this.$inertia.delete(route('tweets.bookmarks.destroy', {id: this.id}), {
                    preserveScroll: true,
                });
            },
            toggleBookmark(){
                this.is_bookmarked ? this.unbookmark() : this.bookmark();
            },
            log(str) {
                console.log(str);
            },
        },
    }
</script>
