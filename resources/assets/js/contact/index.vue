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
                    <contact-form></contact-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import PageHeader from '../helpers/page-header.vue';
    import ContactForm from './form.vue';

    export default {
        data() {
            return {

            };
        },
        components: {
            PageHeader,
            ContactForm
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