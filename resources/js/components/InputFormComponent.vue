<template>
    <form class="form-inline" @submit.prevent="submit">
        <input class="form-control" type="text" placeholder="Name todos" v-model="name" required>
        <button class="btn btn-success" type="submit">Create</button>
    </form>
</template>

<script>
    import { mapMutations } from "vuex";

    export default {
        data() {
            return {
                name: "",
            };
        },
        methods: {
            ...mapMutations(["createTodo"]),
            submit() {
                this.createTodo({
                    name: this.name,
                    id: '',
                    status: 0,
                    done: 0,
                    flag: 0,
                });
                this.name = "";
            }
        }
    }
</script>
