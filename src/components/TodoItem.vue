<template>
    <li class="py-1 px-9 relative">
        <span class="">{{ text }}</span>
        <i class="fa-solid fa-trash absolute right-2 text-red-500 cursor-pointer hover:text-red-400" @click="deleteTask()"></i>
        <i class="fa-solid fa-check absolute left-2 cursor-pointer hover:text-emerald-400" @click="changeStateTask()"></i>
    </li>
</template>
  
<script>
import { store } from './store/store';
import axios from 'axios';
export default {
    name: 'TodoItem',
    data() {
        return {
            store,
            apiUrl: 'http://localhost/Esercizi/php-todo-list-json/src/components/serverFolder/server.php',

        }
    },
    props: ['text'],
    methods: {
        deleteTask() {
            const data = this.generateItem('delete');
            this.postItem(data);

        },
        changeStateTask() {
            const data = this.generateItem('edit');
            this.postItem(data);
        },
        generateItem(action) {
            /* Accept 2 params: edit o delete */
            const data = {
                item: {
                    itemContent: this.text,
                    state: true,
                    'action': action
                },
            };
            return data;
        },
        postItem(data) {
            axios.post(this.apiUrl, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((res) => {
                store.todoList = res.data;
            })
        }
    },
    components: {

    },
    mounted() {

    }
}
</script>
  
<style lang="scss" scoped>
li {
    &:hover i {
        opacity: 1;
    }

    i {
        transition: all .5s;
        opacity: 0;
        top: 50%;
        transform: translateY(-50%);
    }
}
</style>