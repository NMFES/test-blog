<template>
    <div class="row">
        <div class="col-xs-12">
            <page-header>
                <h1>Контакты автора</h1>
            </page-header>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <img src="/storage/images/other/arnold.jpg" alt="Author" class="img-circle author">
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="contacts">
                                <li>
                                    <span class="fa fa-phone"></span> +38-010-550-22-33
                                </li>
                                <li>
                                    <span class="fa fa-skype"></span> author_name
                                </li>
                                <li>
                                    <span class="fa fa-envelope"></span> <a href="mailto:author@site.com">author@site.com</a>
                                </li>
                                <li>
                                    <span class="fa fa-external-link"></span> <a href="http://site.com/">Site.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin turpis ligula, volutpat ac sem quis, efficitur varius lacus. Duis ac sollicitudin eros. Proin at interdum eros, quis vulputate nulla. Aliquam convallis sodales scelerisque. Maecenas viverra libero laoreet odio facilisis molestie. Nullam nibh velit, facilisis posuere congue gravida, fringilla sit amet elit. Vestibulum metus erat, bibendum nec consequat dignissim, laoreet id sapien. Nunc id purus eu nunc dignissim bibendum ac a lacus. Proin pulvinar pretium augue, quis rutrum erat fermentum non. Sed quis est sit amet lectus porttitor imperdiet vel et magna. Mauris sed nulla volutpat elit lobortis mollis consectetur a massa. Aliquam laoreet orci et cursus vehicula. In hac habitasse platea dictumst. Mauris a sapien ligula. Vestibulum et magna sed sapien fermentum placerat.
                    </p>
                    <p>
                        Quisque eu tempus purus, a lobortis diam. Nulla sit amet nisl mollis, sagittis ex ac, finibus sem. Vestibulum cursus eleifend faucibus. Maecenas et odio nec mauris rutrum maximus. Ut eu consectetur urna. Proin sollicitudin, libero sed sodales lobortis, tortor quam molestie quam, non sodales neque nisi vel magna. Nunc consequat porttitor facilisis. Curabitur ante dui, tempus vitae diam eu, volutpat euismod massa. Donec non elit sit amet dolor placerat venenatis. Maecenas eu aliquet mauris. Integer suscipit libero vitae euismod tincidunt. Sed molestie, mi sit amet eleifend iaculis, urna erat pellentesque sem, nec facilisis justo nisl et augue. Aliquam erat volutpat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import PageHeader from '../helpers/page-header.vue';

    export default {
        data() {
            return {

            };
        },
        components: {
            PageHeader
        },
        created() {

        },
        computed: {

        },
        methods: {

        }
    }
</script>
<style lang="scss" scoped>
    .author {
        max-width: 100%;
        max-height: 100%;
    }

    .contacts {
        padding: 0px;
        margin: 0px;

        li {
            padding: 4px 0px;
            margin: 0px;
            list-style-type: none;
            font-size: 16px;
        }
    }
</style>