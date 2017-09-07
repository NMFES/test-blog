<template>
    <div>
        <h3>
            Оставить отзыв
        </h3>
        <div v-if="auth.authenticated()">
            <div v-show="answer.active" class="answer">Ответ для <strong>{{ answer.name }}</strong> <span class="fa fa-close" v-if="answer.active" @click="answer.active = false"></span></div>
            <form @submit.prevent="send">
                <div :class="['form-group', errors.message ? 'has-error' : null]">
                    <label for="inputText">Ваш отзыв</label>
                    <textarea class="form-control" rows="5" id="inputText" v-model="form.message" required="required" :disabled="sending"></textarea>
                    <span class="help-block" v-if="errors.message">{{ errors.message[0] }}</span>
                </div>
                <button type="submit" class="btn btn-default pull-right" :disabled="sending"><span class="fa fa-envelope"></span> Отправить</button>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="alert alert-warning" role="alert" v-else>
            Войдите в свой аккаунт чтобы оставить отзыв
        </div>
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import EventBus from '../helpers/event-bus.vue';
    import Auth from '../helpers/auth';

    export default {
        data() {
            return {
                form: {
                    message: '',
                    parent_id: 0
                },
                answer: {
                    active: false,
                    name: ''
                },
                sending: false,
                errors: {},
                auth: Auth
            };
        },
        mounted() {
            EventBus.$on('focusOnForm', (data) => {
                this.answer.active = true;
                this.answer.name = data.name;
                this.form.parent_id = data.id;

                $('#inputText').focus();
            });
        },
        methods: {
            send() {
                this.sending = true;
                this.form.parent_id = this.answer.active ? this.form.parent_id : 0;

                axios({
                    url: '/api/comment',
                    data: this.form,
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${Auth.state.api_token}`
                    }
                })
                        .then(response => {
                            if (response.data.success) {
                                EventBus.$emit('success', 'Ваш отзыв добавлен');

                                this.form.message = '';

                                this.errors = {};
                                // reloads all comments
                                EventBus.$emit('reloadComments');
                            }

                            this.sending = false;
                            this.answer.active = false;
                        })
                        .catch(e => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            }

                            this.sending = false;
                        });
            }
        },
    }
</script>
<style lang="scss" scoped>
    @import '../../sass/variables';

    .answer {
        font-size: 16px;
        padding: 10px 0px 10px 0px;

        span.fa {
            color: $brand-danger;
            cursor: pointer;
        }
    }
</style>
