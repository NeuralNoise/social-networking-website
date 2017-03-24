<template>
    <li>
        <a href="/notifications">
            Unread Notifications <span class="badge">7</span>
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
                            console.log(response);
                        })
            }
        }
    }
</script>