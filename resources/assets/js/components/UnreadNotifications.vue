<template>
    <li>
        <a href="/notifications">
            Unread Notifications <span class="badge"> {{ allNotificationsCount }} </span>
        </a>
    </li>
</template>

<script>
    export default {
        mounted() {
            this.get_unread();
        },
        methods : {
            get_unread() {
                axios.get('/get_unread')
                        .then((response) => {
                            response.data.forEach( (notification) => {
                                this.$store.commit('addNotifications', notification);
                            });
//                            console.log(response);
                        })
            }
        },
        computed : {
            allNotificationsCount() {
                return this.$store.getters.allNotificationsCount;
            }
        }
    }
</script>