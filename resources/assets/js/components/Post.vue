<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <textarea rows="5" class="form-control" v-model="content"></textarea>
                        <br>
                        <button class="btn btn-success pull-right" :disabled="not_working" @click="createPost">
                            Create a Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                content : '',
                not_working : true,
            }
        },
        methods : {
            createPost() {
                axios.post('/create/post', { content : this.content })
                        .then((response) => {
                           console.log(response);
                            this.content = "";
                            noty({
                                layout: 'topRight',
                                type : 'success',
                                theme : 'relax',
                                text : "Post Created successfully",
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
        watch: {
            content() {
                if(this.content.length > 0) {
                    this.not_working = false;
                }
                else {
                    this.not_working = true;
                }
            }
        }
    }
</script>