<template>
    <div class="row">
        <div class="col-xs-12">
            <page-header>
                <h1 v-if="title">{{ title }}</h1>
            </page-header>
            <div class="post-content">
                <img :src="img" v-if="img" class="img-rounded logo">
                {{ content }}
            </div>
            <div class="date">
                {{ date }}
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import PageHeader from '../helpers/page-header.vue';
    import EventBus from '../helpers/event-bus.vue';

    export default {
        data() {
            return {
                title: '',
                img: '',
                content: '',
                date: '',
                meta_description: '',
                meta_keywords: ''
            };
        },
        components: {PageHeader},
        created() {
            axios.get('/api/post/' + this.$route.params.slug)
                    .then(response => {
                        this.title = response.data.title;
                        this.img = response.data.img;
                        this.content = response.data.content;
                        this.date = response.data.created_at;
                        this.meta_description = response.data.meta_description;
                        this.meta_keywords = response.data.meta_keywords;
                    })
                    .catch(e => {
                        EventBus.$emit('error', 'Возникла ошибка :(');
                    })
        },
        computed: {

        },
        methods: {

        }
    }
</script>
<style lang="scss" scoped>
    @import '../../sass/variables';

    .date {
        font-size: 14px;
        color: $gray-light;
        border-top: 1px solid $gray-lighter;
        text-align: right;
        padding: 3px 10px 5px 10px;
        margin-top: 5px;
    }

    .logo {
        float: left;
        margin: 0px 10px 10px 0px;
    }
</style>

