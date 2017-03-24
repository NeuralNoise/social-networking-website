<template>
        <div class="row">
            <p class="text-center" v-if="loading">
                Loading...
            </p>
            <p class="text-center" v-if="!loading">
                <button class="btn btn-success" v-if="status == 0" @click="addFriend"> Add Friend</button>
                <button class="btn btn-success" v-if="status == 'pending'" @click="acceptFriend"> Accept Friend</button>
                <span class="text-info" v-if="status == 'waiting'"> Waiting for Response</span>
                <span class="text-success" v-if="status == 'friends'"> You are Friends :)</span>
            </p>
        </div>
</template>

<script>
    export default {
        props : ['profile_user_id'],
        data() {
            return {
                status: '',
                loading: true,
            }
        },
        mounted() {
            axios.get('/check_relationship_status/'+this.profile_user_id).then( (response) => {
                console.log(response);
                this.status = response.data.status;
                this.loading = false;
            });
        },
        methods : {
            addFriend() {
                this.loading = true;
                axios.get('/add_friend/'+this.profile_user_id)
                        .then((response) => {
                            if(response.data == 1) {
                                this.status = 'waiting';
                                noty({
                                    type: 'success',
                                    layout : 'bottomRight',
                                    text : 'Friend request sent.'
                                });
                            }
                            this.loading = false;
//                           console.log(response);
                        });
            },
            acceptFriend() {
                this.loading = true;
                axios.get('/accept_friend/'+this.profile_user_id)
                        .then((response) => {
                            if(response.data == 1) {
                                this.status = 'friends';
                                noty({
                                    type: 'success',
                                    layout : 'bottomRight',
                                    text : 'Friend request accepted successfully.'
                                });
                            }
                            this.loading = false;
                        });
            }
        }
    }
</script>