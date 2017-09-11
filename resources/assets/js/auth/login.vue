<template>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <page-header>
                <h1>Вход в аккаунт</h1>
            </page-header>
            <form @submit.prevent="send">
                <div :class="['form-group', errors.email ? 'has-error' : null]">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" v-model="form.email" required="required" :disabled="sending">
                    <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div :class="['form-group', errors.password ? 'has-error' : null]">
                    <label for="inputPassword" class="control-label">Пароль</label>
                    <input type="password" class="form-control" id="inputPassword" v-model="form.password" required="required" :disabled="sending">
                    <span class="help-block" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>
                <button type="submit" class="btn btn-default btn-block" :disabled="sending">Войти</button>
            </form>
        </div>
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import EventBus from '../helpers/event-bus.vue';
    import Auth from '../helpers/auth';
    import PageHeader from '../helpers/page-header.vue';

    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                sending: false,
                errors: {}
            };
        },
        components: {
            PageHeader
        },
        methods: {
            send() {
                this.sending = true;

                axios
                        .post('/api/login', this.form)
                        .then(response => {
                            if (response.data.authenticated) {
                                Auth.set(response.data.api_token, response.data.user_id, response.data.name);
                        
                                EventBus.$emit('success', 'Выполнен вход в аккаунт');

                                this.$router.push('/');
                            }

                            this.sending = false;
                        })
                        .catch(e => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data;
                            }

                            this.sending = false;
                        });
            }
        }
    }
</script>
<style lang="scss" scoped>

</style>