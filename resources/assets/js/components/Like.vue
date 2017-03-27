<template>
    <div>
        <hr>
        <p class="text-center" v-for="like in post.likes">
            <img :src="like.user.avatar" alt="" width="20px" height="20px" class="avatar-like">
            <!--<img :src="post.user.avatar" alt="" width="20px" height="20px">-->
            <!--<img :src="post.user.avatar" alt="" width="20px" height="20px">-->
            <!--<img :src="post.user.avatar" alt="" width="20px" height="20px">-->
            <!--<img :src="post.user.avatar" alt="" width="20px" height="20px">-->
            <!--<img :src="post.user.avatar" alt="" width="20px" height="20px">-->
        </p>
        <hr>
        <button class="btn btn-xs btn-primary" v-if="!auth_user_likes_post" @click="like()">
            Like Post
        </button>

        <button class="btn btn-xs btn-danger" v-else @click="unlike()">
            Unlike Post
        </button>
    </div>
</template>

<script>
    export default {
        mounted () {

        },
        methods:{
          like() {
               axios.get('/like/' + this.id)
                       .then( (response) => {
                           this.$store.commit('update_post_likes', {
                               id: this.id,
                               like : response.data
                           });
                           noty({
                               layout: 'topRight',
                               type : 'success',
                               theme : 'relax',
                               text : "Successfully Liked.",
                               timeout: 3000, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
                               progressBar: true, // [boolean] - displays a progress bar

                               animation: {
                                   open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                                   close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                                   easing: 'swing',
                                   speed: 500 // opening & closing animation speed
                               },
                               closeWith: ['click']
                           });
                       });
            },
            unlike() {
                axios.get('/unlike/' + this.id)
                        .then( (response) => {
                            this.$store.commit('unlike_post', {
                                post_id: this.id,
                                like_id : response.data
                            });
                            noty({
                                layout: 'topRight',
                                type : 'success',
                                theme : 'relax',
                                text : "Successfully Unliked this Post.",
                                timeout: 3000, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
                                progressBar: true, // [boolean] - displays a progress bar

                                animation: {
                                    open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                                    close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                                    easing: 'swing',
                                    speed: 500 // opening & closing animation speed
                                },
                                closeWith: ['click']
                            });
                        });

                }
        },
        props: ['id'],
        computed : {
            likers() {
                var likers = [];

                this.post.likes.forEach( (like) => {
                    likers.push(like.user.id);
                });

                return likers;
            },
            auth_user_likes_post() {
                var checK_index = this.likers.indexOf(this.$store.state.auth_user.id)
                if(checK_index == -1)
                    return false;
                else
                    return true;
            },
            post() {
                return this.$store.state.posts.find( (post) =>{
                    return post.id === this.id
                });
            }
        }

    }
</script>

<style>
    .avatar-like {
        border-radius: 50%;
    }
</style>