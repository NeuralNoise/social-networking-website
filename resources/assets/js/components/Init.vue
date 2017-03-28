<template>
    <div>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_auth_user_data();
            this.get_user_friend_list_id();
            this.get_user_friend_list();
        },
        methods: {
            get_auth_user_data() {
                axios.get('/get_auth_user_data')
                        .then((response) => {
                            this.$store.commit('auth_user_data', response.data);
                            console.log(response);
                        });
            },
            get_user_friend_list_id() {
                axios.get('/get_user_friend_list_id')
                        .then((response) => {
//                            this.$store.commit('populate_friend_list', response.data);
//                            console.log(response.data);
                            response.data.forEach( (e) => {
                                this.$store.commit('populate_friend_list_id', e);
                            } );

                        });
            },
            get_user_friend_list() {
                axios.get('/get_user_friend_list')
                        .then((response) => {
                            response.data.forEach( (e) => {
                                this.$store.commit('populate_friend_list', e);
                            } );

                        });
            }
        }
    }
</script>