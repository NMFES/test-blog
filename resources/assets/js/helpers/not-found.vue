<template>
    <div class="row">
        <div class="col-xs-12">
            <page-header>
                <h1>Страница не найдена</h1>
            </page-header>
            <img src="/storage/images/other/404.gif">
        </div>
    </div>
</template>
<script type="text/javascript">
    import PageHeader from './page-header.vue';

    export default {
        components: {
            PageHeader
        }
    }
</script>
<style lang="scss" scoped>
    img {
        margin: 20px auto;
        border: 0px;
        display: block;
    }
</style>