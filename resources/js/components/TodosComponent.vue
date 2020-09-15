<template>
    <div class="row">
        <div class="col-md-6">
            <div
                class="flex-list"
                v-for="todo in getAllTodo"
            >
                <span>
                    <i @click="drag('dragTodoRight', todo)" class="fa fa-arrow-right"  aria-hidden="true"></i>
                    <i @click="complete(todo)" v-bind:class="{ 'fa fa-circle-o': todo.done == 0, 'fa fa-check-circle-o': todo.done == 1 }"  aria-hidden="true"></i>
                    <i @click.prevent="deleteTodo('removeTodoLeft', todo)" class="fa fa-trash" aria-hidden="true"></i>
                </span>
                {{ todo.name }}
            </div>
        </div>
        <div class="col-md-6">
            <h1>Количество <span v-bind:class="{ active: getAllTodoDrag.length >= 3 }">{{ getAllTodoDrag.length }}</span></h1>
            <div
                class="flex-list"
                v-for="todoDrag in getAllTodoDrag"
            >
                  <span>
                    <i @click="drag('dragTodoLeft', todoDrag)" class="fa fa-arrow-left"  aria-hidden="true"></i>
                    <i @click="complete(todoDrag)" v-bind:class="{ 'fa fa-circle-o': todoDrag.done == 0, 'fa fa-check-circle-o': todoDrag.done == 1 }"  aria-hidden="true"></i>
                    <i @click.prevent="deleteTodo('removeTodoRight', todoDrag)" class="fa fa-trash" aria-hidden="true"></i>
                </span>
                {{ todoDrag.name }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$store.dispatch("allTodoFromDatabase")
        },
        computed: {
            getAllTodo(){
                return this.$store.getters.getTodoFormGetters
            },
            getAllTodoDrag(){
                return this.$store.getters.getDragTodoFormGetters
            }
        },
        methods: {
            deleteTodo(removeTodo, todo) {
                this.$store.dispatch(removeTodo, todo)
            },
            complete(todo){
                this.$store.dispatch('completeTodo', todo)
            },
            drag(dragToDo, todo){
                this.$store.dispatch(dragToDo, todo)
            },
        }
    }
</script>

<style>
    .flex-list{
        display: flex;
    }

    .flex-list i{
        margin: 0 5px;
        cursor: pointer;
    }

    h1 .active{
        color: red;
    }
</style>
