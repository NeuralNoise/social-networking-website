<template>
    <div>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.listen()
        },
        props: ['id'],
        methods: {
            listen() {
                Echo.private('App.User.' + this.id)
                        .notification( (notification) => {
                            noty({
                                layout: 'topRight',
                                type : 'success',
                                theme : 'relax',
                                text : notification.name + " " + notification.message,
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
                            document.getElementById("noty_audio").play();
                            console.log(notification);
                        })
            }
        }
    }
</script>