<template>
    <div class="row">
        <div class="col-xs-12">
            <page-header>
                <h1>Отзывы об авторе</h1>
            </page-header>
        </div>
        <div class="col-xs-12">
            <comment-form></comment-form>
            <comment-item v-for="(comment, index) in comments" :key="comment.id" :data="comment"></comment-item>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue';
    import axios from 'axios';
    import EventBus from '../helpers/event-bus.vue';
    import PageHeader from '../helpers/page-header.vue';
    import CommentForm from './form.vue';
    import CommentItem from './item.vue';

    export default {
        data() {
            return {
                comments: {}
            };
        },
        components: {
            PageHeader,
            CommentForm,
            CommentItem
        },
        created() {
            this.load();
            
            EventBus.$on('reloadComments', () => {
                this.load();
            });
        },
        methods: {
            load() {
                axios.get('/api/comment')
                        .then(response => {
                            Vue.set(this.$data, 'comments', response.data);
                        })
                        .catch(e => {
                            EventBus.$emit('error', 'Возникла ошибка :(');
                        })
            }
        }
    }
</script>
<style scoped>

</style>
