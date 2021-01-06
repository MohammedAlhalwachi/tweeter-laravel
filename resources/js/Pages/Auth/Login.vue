<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo/>
        </template>

        <jet-validation-errors class="mb-4"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus/>
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password"/>
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                           autocomplete="current-password"/>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model="form.remember"/>
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4">
                <!--<p class="block font-bold text-md text-gray-700 my-4">Or</p>-->
                <p class="block font-medium text-sm text-gray-700">Login as</p>

                <div class="flex space-x-2">
                    <jet-secondary-button class="block mt-1" @click.native="setDemoAccount(0)">
                        Guest 1
                    </jet-secondary-button>
                    <jet-secondary-button class="block mt-1" @click.native="setDemoAccount(1)">
                        Guest 2
                    </jet-secondary-button>
                    <jet-secondary-button class="block mt-1" @click.native="setDemoAccount(2)">
                        Guest 3
                    </jet-secondary-button>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link v-if="canResetPassword" :href="route('password.request')"
                              class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetSecondaryButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                }),
                demoAccounts: [
                    { email: 'jeffrey34@example.net', password: 'password' },
                    { email: 'lourdes65@example.org', password: 'password' },
                    { email: 'ilegros@example.org', password: 'password' }
                ],
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ...data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            },
            setDemoAccount(index) {
                this.form.email = this.demoAccounts[index].email;
                this.form.password = this.demoAccounts[index].password;
                this.submit();
            },
        },
        mounted() {
            console.log('sdlksdlkj');
        }
    }
</script>
