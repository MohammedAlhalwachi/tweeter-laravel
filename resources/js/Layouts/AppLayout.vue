<template>
    <div class="pb-16 min-h-screen bg-gray-100">
        <nav class="relative z-10 bg-white shadow">
            <!-- Primary Navigation Menu -->
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex flex-shrink-0 items-center">
                        <inertia-link :href="route('home')">
                            <jet-application-mark class="block w-8 w-auto text-blue-500" />
                        </inertia-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 font-bold sm:ml-10 sm:flex">
                        <jet-nav-link :href="route('home')" :active="route().current('home')">
                            Home
                        </jet-nav-link>
                        <jet-nav-link :href="route('explore.top')" :active="route().current('explore.*')">
                            Explore
                        </jet-nav-link>
                        <jet-nav-link :href="route('bookmarks.tweets')" :active="route().current('bookmarks.*')">
                            Bookmarks
                        </jet-nav-link>

                        <!-- FIXME:: Remove this. Only for testing -->
                        <jet-nav-link :href="route('profile.show', {username: 'malhalwachi' })" :active="false">
                            Test malhalwachi
                        </jet-nav-link>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden select-none sm:flex sm:items-center sm:ml-6">
                        <div class="relative ml-3">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex items-center text-sm rounded-full border-2 border-transparent transition duration-150 ease-in-out focus:outline-none">
                                        <div class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                            <div>
                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>

                                            <div class="ml-1">{{ $page.props.user.name }}</div>
                                        </div>
                                        <current-user-avatar class="ml-2" />
                                    </button>

                                    <button v-else class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                        <div>{{ $page.props.user.name }}</div>

                                        <div class="ml-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block py-2 px-4 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show', {username: $page.props.user.username || ''})" :active="route().current('profile.show')">
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('settings.show')" :active="route().current('settings.show')">
                                        Settings
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                                        <div class="block py-2 px-4 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="route('teams.show', $page.props.user.current_team)">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block py-2 px-4 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.props.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 w-5 h-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div class="border-t border-gray-100"></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center -mr-2 sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex justify-center items-center p-2 text-gray-400 rounded-md transition duration-150 ease-in-out hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
<!--                <div class="pt-2 pb-3 space-y-1">-->
<!--                    <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                        Dashboard-->
<!--                    </jet-responsive-nav-link>-->
<!--                </div>-->

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="w-10 h-10 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ $page.props.user.name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ $page.props.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="route('profile.show', {username: $page.props.user.username || ''})" :active="route().current('profile.show')">
                            Profile
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="route('settings.show')" :active="route().current('settings.show')">
                            Settings
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.props.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block py-2 px-4 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')">
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block py-2 px-4 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.props.user.all_teams">
                                <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 w-5 h-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

<!--        &lt;!&ndash; Page Heading &ndash;&gt;-->
<!--        <header class="bg-white shadow">-->
<!--            <div class="py-6 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">-->
<!--                <slot name="header"></slot>-->
<!--            </div>-->
<!--        </header>-->

        <!-- Page Content -->
        <main>
            <transition enter-active-class="duration-300 ease-out"
                        enter-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="duration-300 ease-out"
                        leave-class="opacity-100"
                        leave-to-class="opacity-0"
                        mode="out-in">
                <slot></slot>
            </transition>
        </main>

        <footer class="flex fixed inset-x-0 bottom-0 z-30 justify-between bg-white border-t border-gray-200 shadow-md sm:hidden">
            <footer-nav-link :href="route('home')" :active="route().current('home')">
                <svg class="inline-block w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
            </footer-nav-link>
            <footer-nav-link :href="route('explore.top')" :active="route().current('explore.*')">
                <svg class="inline-block" width="24" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                     clip-rule="evenodd">
                    <path
                        d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm1.476 14.955c.988-.405 1.757-1.211 2.116-2.216l2.408-6.739-6.672 2.387c-1.006.36-1.811 1.131-2.216 2.119l-3.065 7.494 7.429-3.045zm-.122-4.286c.551.551.551 1.446 0 1.996-.551.551-1.445.551-1.996 0-.551-.55-.551-1.445 0-1.996.551-.551 1.445-.551 1.996 0z"/>
                    </svg>
            </footer-nav-link>
            <footer-nav-link :href="route('bookmarks.tweets')" :active="route().current('bookmarks.*')">
                <svg class="inline-block w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                </svg>
            </footer-nav-link>
        </footer>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
        
        <!-- Image Viewer -->
        <portal-target name="imageViewer" class="relative z-50" multiple></portal-target>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import FooterNavLink from "@/Components/FooterNavLink";
    import CurrentUserAvatar from "@/Components/CurrentUserAvatar";

    export default {
        components: {
            CurrentUserAvatar,
            FooterNavLink,
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },
            
            log(val) {
                console.log(val);
            },

            logout() {
                axios.post(route('logout')).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
