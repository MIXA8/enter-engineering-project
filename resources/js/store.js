import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        globalList: [],
    },
    mutations: {
        addToList(state, newItem) {
            state.globalList.push(newItem);
        },
        // Другие мутации по необходимости
    },
    actions: {
        // Действия по необходимости
    },
    getters: {
        getGlobalList: state => state.globalList,
        // Другие геттеры по необходимости
    },
});
