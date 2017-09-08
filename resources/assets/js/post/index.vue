<template>
    <div class="row">
        <div class="col-xs-12">
            <page-header>
                <h1>Последние заметки</h1>
            </page-header>
            <div v-for="post in posts" class="post">
                <router-link :to="'/post/' + post.slug"><img :src="post.img" class="media-object img-rounded"></router-link>
                <div class="body">
                    <router-link :to="'/post/' + post.slug"><h3>{{ post.title }}</h3></router-link>
                    {{ post.description }}
                    <div class="date">
                        {{ post.created_at }}
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="paginator">
                <v-paginator :options="options" :resource_url="resource_url" ref="vpaginator" @update="updateResource"></v-paginator>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import axios from 'axios'
    import VueAxios from 'vue-axios'
    import VuePaginator from 'vuejs-paginator';
    import EventBus from '../helpers/event-bus.vue';
    import PageHeader from '../helpers/page-header.vue';

    Vue.use(VueAxios, axios, VuePaginator);

    export default {
        data() {
            return {
                posts: [],
                resource_url: '/api/post',
                options: {
                    remote_data: 'data',
                    remote_current_page: 'current_page',
                    remote_last_page: 'last_page',
                    remote_next_page_url: 'next_page_url',
                    remote_prev_page_url: 'prev_page_url',
                    next_button_text: 'Предыдущая',
                    previous_button_text: 'Следующая',
                    headers: {
                        // vue-paginator does'n allow transfering custom data
                        // in request_url. So, that's why we use headers
                        'Query': this.getQuery()
                    }
                }
            };
        },
        components: {VPaginator: VuePaginator, PageHeader},
        methods: {
            updateResource(data) {
                this.posts = data;
            },
            reload() {
                // update Query-header with query-string
                this.options.headers.Query = this.getQuery();
                this.$refs.vpaginator.fetchData(this.resource_url);
            },
            getQuery() {
                return this.$route.params.query ? this.$route.params.query : '';
            }
        },
        watch: {
            // Bug fix. When we are on /search/query page and click on "/" route
            // we need to manualy reload posts, because we are staying
            // in the same component index.vue and changing route in this case
            // doesn't triggers "created()" event.
            '$route'() {
                this.reload();
            }
        },
        created() {
            EventBus.$on('search', () => {
                this.reload();
            });
        },
        destroyed() {
            EventBus.$off('search');
        }
    }
</script>
<style lang="scss" scoped>
    @import '../../sass/variables';

    .post {
        a {
            &:hover {
                text-decoration: none;
                h3 {
                    color: $gray-light;
                }
            }
        }

        img {
            float: left;
            margin: 0px 10px 10px 0px;
        }

        .date {
            font-size: 14px;
            color: $gray-light;
            border-top: 1px solid $gray-lighter;
            text-align: right;
            padding: 3px 10px 5px 10px;
            margin-top: 5px;
        }
    }

    .paginator {
        text-align: center;
        margin: 20px auto;
    }
</style>

