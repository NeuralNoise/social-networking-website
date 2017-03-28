<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-default" v-for="post in posts">
                    <div class="panel-heading" >
                        <img :src="post.user.avatar" alt="" width="40px" height="40px" class="avatar-feed">
                        {{ post.user.name }}
                        <span class="pull-right"> {{ post.created_at }} </span>
                    </div>

                    <div class="panel-body">
                       <p class="text-center"> {{ post.content }} </p>
                        <Like :id="post.id"></Like>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Like from './Like.vue'

    export default {
        mounted() {
            this.get_feed();
            let channel = Echo.private('new-post-create')
                    .listen('NewPostCreated', (e) => {
                        if(this.$store.state.friend_list_id.indexOf(e.post.user_id) > -1){
                            this.$store.commit('update_posts', e.post);
                        }
                    });
        },
        components : {
            Like
        },
        created () {
            this.interval = setInterval(() => {
                // setting this will trigger computed re-evaluation
                this.posts = this.$store.getters.allPosts;
            }, 500);

        },
        methods : {
            get_feed() {
                axios.get('/feed')
                        .then( (response) => {
                            response.data.forEach( (post) => {
                                this.$store.commit('addPosts', post);
                            });
//                            console.log(response);
                        });
            }
        },
        computed : {
            posts() {
                return this.$store.getters.allPosts;
            }
        }
    }
</script>

<style>
    .avatar-feed {
        border-radius:50%;
    }
</style>