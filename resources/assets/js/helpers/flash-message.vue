<template>
    <div>
        <div class="alert alert-success" v-if="success" role="alert" v-html="success"></div>
        <div class="alert alert-danger" v-if="error" role="alert" v-html="error"></div>
    </div>
</template>
<script type="text/javascript">
    import EventBus from './event-bus.vue';

    export default {
        data() {
            return {
                success: '',
                error: ''
            };
        },
        methods: {

        },
        created() {
            EventBus.$on('success', (message) => {
                this.success = '<strong>Все хорошо.</strong> ' + message;

                setTimeout(() => {
                    this.success = '';
                }, 3000);
            });

            EventBus.$on('error', (message) => {
                this.error = '<strong>Ошибка!</strong> ' + message;

                setTimeout(() => {
                    this.error = '';
                }, 6000);
            });
        }
    }
</script>
<style lang="scss" scoped>
    .alert {
        text-align: center;
    }
</style>
