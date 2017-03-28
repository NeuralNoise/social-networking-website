<template>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default" v-for="post in users_post">
                <div class="panel-heading" >
                    <img :src="post.user.avatar" alt="" width="40px" height="40px" class="avatar-feed">
                    {{ post.user.name }}
                    <span class="pull-right"> {{ post.created_at }} </span>
                </div>

                <div class="panel-body">
                    <p class="text-center">  {{ post.content }} </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Like from '../components/Like.vue'

    export default {
        mounted() {
            this.get_users_feed();
        },
        components : {
            Like
        },
        props : ['user_id'],
        data() {
            return {
                users_post : [],
            }
        },
        methods : {
            get_users_feed() {
                axios.get('/users_feed/'+this.user_id)
                        .then((response) => {
                            response.data.forEach( (e) => {
                                this.users_post.push(e);
                            } );
                        });
            },
        },
    }
</script>