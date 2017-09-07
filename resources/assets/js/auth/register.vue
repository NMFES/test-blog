<template>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <page-header>
                <h1>Регистрация</h1>
            </page-header>
            <form @submit.prevent="send">
                <div :class="['form-group', errors.name ? 'has-error' : null]">
                    <label for="inputName" class="control-label">Имя</label>
                    <input type="text" class="form-control" id="inputName" v-model="form.name" required="required" :disabled="sending">
                    <span class="help-block" v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
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
                <div :class="['form-group', errors.password_confirmation ? 'has-error' : null]">
                    <label for="inputPassword2" class="control-label">Повторите пароль</label>
                    <input type="password" class="form-control" id="inputPassword2" v-model="form.password_confirmation" required="required" :disabled="sending">
                </div>
                <button type="submit" class="btn btn-default btn-block" :disabled="sending">Отправить</button>
            </form>
        </div>
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import EventBus from '../helpers/event-bus.vue';
    import PageHeader from '../helpers/page-header.vue';

    export default {
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
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
                        .post('/api/register', this.form)
                        .then(response => {
                            if (response.data.success) {
                                EventBus.$emit('success', 'Поздравляем! Вы успешно зарегистрировались.');

                                this.$router.push('/login');
                            }

                            this.sending = false;
                        })
                        .catch(e => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            }

                            this.sending = false;
                        });
            }
        }
    }
</script>
<style lang="scss" scoped>

</style>