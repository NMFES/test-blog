<template>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <router-link to="/" class="navbar-brand">Brand</router-link>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><router-link to="/contacts">Контакты</router-link></li>
                        <li><router-link to="/comments">Отзывы</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-user-circle" v-if="!auth.authenticated()"></span>
                                <span v-if="auth.authenticated()">{{ auth.state.name }}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li v-if="!auth.authenticated()"><router-link to="/login">Вход</router-link></li>
                        <li v-if="!auth.authenticated()"><router-link to="/register">Регистрация</router-link></li>
                        <li v-if="auth.authenticated()"><a href="#" @click.stop="logout">Выход</a></li>
                    </ul>
                    </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <flash-message></flash-message>
        <div class="row">
            <div class="col-xs-12">
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Auth from './helpers/auth';
    import axios from 'axios';
    import FlashMessage from './helpers/flash-message.vue';
    import EventBus from './helpers/event-bus.vue';

    export default {
        data() {
            return {
                auth: Auth
            };
        },
        created() {
            axios.interceptors.response.use(
                    (response) => {
                return response;
            },
                    (error) => {
                if (error.response.status === 401) {
                    Auth.remove();

                    this.$router.push('/login');
                }

                if (error.response.status === 500) {
                    EventBus.$emit('error', error.response.statusText);
                }

                if (error.response.status === 404) {
                    this.$router.push('/not-found');
                }

                return Promise.reject(error);
            });

            // try to log in
            Auth.init();
        },
        methods: {
            logout() {
                axios({
                    url: '/api/logout',
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${Auth.state.api_token}`
                    }
                }).then(response => {
                    if (response.data.success) {
                        Auth.remove();

                        EventBus.$emit('success', 'Вы вышли из аккаунта.');

                        this.$router.push('/login');
                    }

                    // removing "open" class, close up a menu
                    $('li.dropdown').removeClass('open');
                });
            }
        },
        components: {
            FlashMessage
        }
    }
</script>
<style scoped>
    .container {
        padding-top: 20px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .25s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0
    }
</style>