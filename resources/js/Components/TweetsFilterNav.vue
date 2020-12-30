<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
        <ul class="relative py-3">
            <sidebar-nav-link v-for="(link, index) in links" :key="index" :href="link.route" :active="link.active">
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
    }
</script>

<style scoped>

</style>
