import Vuex from 'vuex';
import Vue from 'vue';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        notifications : [],
        posts : [],
        auth_user : {},
        friend_list_id : [],
        friend_list : [],
    },
    getters: {
        allNotifications(state) {
            return state.notifications;
        },
        allNotificationsCount(state) {
            return state.notifications.length;
        },
        allPosts(state) {
            return state.posts;
        },
        get_friends_list(state) {
            return state.friend_list;
        },
        get_auth_user_id(state) {
            return state.auth_user.id;
        }
    },
    mutations : {
        addNotifications(state, notification) {
            state.notifications.push(notification);
        },
        addPosts(state, post) {
            state.posts.push(post);
        },
        update_posts(state, post) {
            var start_index = 0;
            var number_of_elements_to_remove = 0;
            state.posts.splice(start_index, number_of_elements_to_remove,post);
        },
        auth_user_data(state, user) {
            state.auth_user = user;
        },
        populate_friend_list_id(state, user_id) {
            state.friend_list_id.push(user_id);
        },
        populate_friend_list(state, user) {
            state.friend_list.push(user);
        },
        update_post_likes(state, payload) {
            var post = state.posts.find( (post) => {
                return post.id === payload.id
            });
            post.likes.push(payload.like);
        },
        unlike_post(state, payload) {
            var post = state.posts.find( (post) => {
                return post.id === payload.post_id
            });

            var like = post.likes.find( (like) => {
                return like.id === payload.like_id;
            });
            var index = post.likes.indexOf(like);
            post.likes.splice(index, 1);
        }
    },
    actions : {

    }
});