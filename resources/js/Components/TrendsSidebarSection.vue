<template>
        <v-card>
            <template #header>
                Trends for you
            </template>

            <div class="space-y-4">
                <div v-for="hashtag of hashtags">
                    <p class="font-bold text-gray-800">#{{ hashtag }}</p>
                    <p class="mt-1 text-sm text-gray-500">{{ Math.ceil(Math.random() * 100) }}k Tweets</p>
                </div>
            </div>
        </v-card>
    </aside>
</template>
<script>
    import VCard from "@/Components/Card"

    export default {
        name: 'sidebar',
        components: {VCard},
        data() {
            return {
                hashtags: [
                    'Lorem',
                    'ipsum',
                    'dolor',
                    'sit',
                    'amet',
                    'consectetur',
                    'adipisicing',
                ]
            }
        },
    }
</script>
