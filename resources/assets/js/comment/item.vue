<template>
    <div :class="['media', 'level-' + data.level]" @mouseenter="captured = true" @mouseleave="captured = false">
        <div class="media-left">
            <img class="media-object img-circle" :src="data.img">
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                {{ data.name }} 
                <span class="fa fa-clock-o"> {{ data.created_at }}</span>
                <a href="#" @click.prevent="focus(data)" class="reply" v-show="captured && auth.authenticated()"><span class="fa fa-hand-o-down"></span> Ответить</a>
            </h4>
            {{ data.message }}
        </div>
    </div>
</template>
<script type="text/javascript">
    import EventBus from '../helpers/event-bus.vue';
    import Auth from '../helpers/auth';

    export default {
        props: ['data'],
        data() {
            return {
                captured: false,
                auth: Auth
            };
        },
        methods: {
            focus(data) {
                EventBus.$emit('focusOnForm', data);
            }
        }
    }
</script>
<style lang="scss" scoped>
    @import '../../sass/variables';

    @for $i from 0 through 3 {
        $padding: 80px * $i;

        .level-#{$i} {
            padding-left: $padding;
        }
    }

    .media img {
        max-width: 80px;
        max-height: 80px;
    }

    .media-heading { 
        span.fa {
            font-size: 12px;
            color: $gray-light;
            padding-left: 10px;
        }

        .reply {
            font-size: 14px;

            &:hover {
                text-decoration: none;
            }
        }
    }
</style>