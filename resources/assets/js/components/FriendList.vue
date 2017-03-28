<template>
    <div>
        <!--<div style="display: inline-block" v-for="friend in friends">
            <img :src="'/'+friend.avatar" alt="" width="60px" height="60px" class="searched-user">
            <br>
            <a :href="'/profile/' + friend.slug"> {{ friend.name }} </a>
        </div>-->
        <ul>
            <li v-for="friend in friends">
                <a :href="'/profile/' + friend.slug"> {{ friend.name }} </a>
            </li>
        </ul>


    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_friends();
        },
        props : ['profile_user_id'],
        data() {
          return {
              friends : [],
          }
        },
        methods: {
            get_friends(){
                axios.get('/get_user_friend_list/'+this.profile_user_id)
                        .then((response) => {
                            response.data.forEach( (e) => {
                                this.friends.push(e);
                            } );

                        });
            },
        },
    }
</script>

<style>
    .searched-user {
        border-radius: 50%;
    }
</style>