<template>
    <div class="page-header">
        <slot></slot>
    </div>
</template>
<script type="text/javascript">
    export default {
        data() {
            return {};
        }
    }
</script>
<style lang="scss" scoped>
    .page-header {
        margin: 2px 0px 10px 0px;
        text-align: center;
        
        h1 {
            margin: 0px;
        }
    }
</style>