<template>
    <div :class="['media', 'level-' + data.level]">
        <div class="media-left">
            <img class="media-object img-circle" :src="data.img">
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ data.name }} <span class="fa fa-clock-o"> {{ data.created_at }}</span></h4>
            {{ data.message }}
        </div>
    </div>
</template>
<script type="text/javascript">
    export default {
        props: ['data'],
        mounted() {

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

    .media-heading span {
        font-size: 12px;
        color: $gray-light;
        padding-left: 10px;
    }
</style>