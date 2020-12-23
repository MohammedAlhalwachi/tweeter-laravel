<template>
    <user-avatar :src="$page.props.user.profile_photo_url" :name="$page.props.user.name" />
</template>
<script>
    import UserAvatar from "@/Components/UserAvatar";
    
    export default {
        name: 'avatar-img',
        components: {UserAvatar}
    }
</script>
