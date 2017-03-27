<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <input type="text" class="input-lg form-control" placeholder="Search for other Users" v-model="query" @keyup.enter="search()">
                <br>
                <div class="row" v-if="results.length">
                    <div class="text-center" v-for="user in results">
                        <img :src="user.avatar" alt="" width="40px" height="40px" class="searched-user"> <a :href="'/profile/' + user.slug"> {{ user.name }} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var algoliasearch = require('algoliasearch');
    var client = algoliasearch('RVXBD29EBT', '0963ae2dd6926487b9a814073872e17a');
    var index = client.initIndex('users');
    export default {
        mounted() {

        },
        data() {
          return {
              query:'',
              results : [],
          }
        },
        methods: {
            search() {
                index.search(this.query, (err, content) => {
                    this.results = content.hits;
                    console.log(content.hits);
                })
            }
        },
    }
</script>

<style>
    .searched-user {
        border-radius: 50%;
    }
</style>