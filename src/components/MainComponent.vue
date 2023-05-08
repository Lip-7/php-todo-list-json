<template>
    <main class="container p-10 pt-20 flex justify-center mx-auto ">
        <div class="todoWrap text-center mx-auto border border-slate-600 rounded p-5 text-white">
            <h1 class=" text-4xl font-bold text-white pb-3">{{ title }}</h1>
            <ul class="">
               <!--  <li v-for="(todo, index) in todoList" :key="index" class="m-1" :class="{'bg-slate-700' : todo.state, 'bg-emerald-800 decoration-slice' : !todo.state}">{{ todo.itemContent }}</li> -->
                <TodoItem v-for="(todo, index) in store.todoList" :key="index" class="m-1" :class="{'bg-slate-700' : todo.state, 'bg-emerald-800 decoration-slice' : !todo.state}" :text="todo.itemContent"></TodoItem>
            </ul>
            <div class="p-5 space-x-2">
                <input class="text-black" @keyup.enter="updateList()" v-model="todoItem" type="text">
                <button id="subButton" class=" py-2 px-3 bg-slate-500 rounded-full" @click="updateList()">Submit</button>
            </div>
        </div>
    </main>
</template>
  
<script>
import { store } from './store/store';
import axios from 'axios';
import TodoItem from './TodoItem.vue';
export default {
    name: 'MainComponent',
    data() {
        return {
            store,
            title: 'Todo List',
            /* todoList: ["HTML","CSS","RESPONSIVE DESIGN","JavaScript","PHP"], */
            apiUrl: 'http://localhost/Esercizi/php-todo-list-json/src/components/serverFolder/server.php', 
            todoItem: '',
        }
    },
    methods: {
        readList() {
            axios.get(this.apiUrl).then((res) => {
                store.todoList = res.data;
            })
            /* fetch(this.apiUrl).then((res) => res.json()).then(res => {
                console.log(res);
            }) */
        },
        updateList() {
            const data = {
                item: {
                    itemContent: this.todoItem,
                    state: true,
                },
            };
            axios.post(this.apiUrl, data, {
                headers: {
                'Content-Type': 'multipart/form-data'
            }}).then((res) => {
                this.todoItem = '';
                store.todoList = res.data
            })
        }
    },
    components: {
        TodoItem,
    },
    mounted() {
        this.readList();
    }
}
</script>
  
<style lang="scss" scoped></style>