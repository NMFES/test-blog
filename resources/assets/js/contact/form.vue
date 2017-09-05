<template>
    <div>
        <h3>
            Написать мне сообщение
        </h3>
        <form @submit.prevent="send">
            <div :class="{'form-group' : true, 'has-error' : errors.email}">
                <label for="inputEmail" class="control-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" v-model="form.email" required="required" :disabled="sending">
                <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
            </div>
            <div :class="{'form-group' : true, 'has-error' : errors.message}">
                <label for="inputText">Ваше сообщение</label>
                <textarea class="form-control" rows="5" id="inputText" v-model="form.message" required="required" :disabled="sending"></textarea>
                <span class="help-block" v-if="errors.message">{{ errors.message[0] }}</span>
            </div>
            <button type="submit" class="btn btn-default btn-block" :disabled="sending"><span class="fa fa-envelope"></span> Отправить</button>
        </form>
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import EventBus from '../helpers/event-bus.vue';

    export default {
        data() {
            return {
                form: {
                    email: '',
                    message: ''
                },
                sending: false,
                errors: {}
            };
        },
        created() {

        },
        mounted() {
            
        },
        computed: {

        },
        methods: {
            send() {
                this.sending = true;

                axios
                        .post('/api/contact/message', this.form)
                        .then(response => {
                            if (response.data.success) {
                                EventBus.$emit('success', 'Ваше сообщение отправлено');

                                this.form.email = '';
                                this.form.message = '';

                                this.errors = {};
                            }

                            this.sending = false;
                        })
                        .catch(e => {
                            if (e.response.status == 422) {
                                this.errors = e.response.data.errors;
                            }
                            
                            this.sending = false;
                        });
            }
        },
        watch: {

        }
    }
</script>
<style lang="scss" scoped>
    h3 {
        text-align: center;
    }

    form {
        button {
            margin-bottom: 20px;
        }
    }
</style>

