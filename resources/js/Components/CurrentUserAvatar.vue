<template>
    <user-avatar :src="$page.user.profile_photo_url" :name="$page.user.name" />
</template>
<script>
    import UserAvatar from "@/Components/UserAvatar";
    
    export default {
        name: 'avatar-img',
        components: {UserAvatar}
    }
</script>
