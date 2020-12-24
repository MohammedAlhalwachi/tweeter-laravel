<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
        <ul class="relative py-3">
            <sidebar-nav-link v-for="link in links" :href="link.route" :active="link.active">
                {{ link.name }}
            </sidebar-nav-link>
        </ul>
    </div>
</template>

<script>
    import SidebarNavLink from "@/Components/SidebarNavLink";

    export default {
        name: "SidebarList",
        components: {SidebarNavLink},
        props: ['links'],
        mounted() {
            console.log(route().current('profile.show'));
            console.log(route('profile.show', {username: this.$page.props.user.email}));
        }
    }
</script>

<style scoped>

</style>
