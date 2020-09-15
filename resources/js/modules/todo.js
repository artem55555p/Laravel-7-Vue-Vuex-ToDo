export default {
    state: {
        todo: [],
        todoDrag: []
    },
    getters: {
        getTodoFormGetters(state){
            return state.todo
        },
        getDragTodoFormGetters(state){
            return state.todoDrag
        }
    },
    actions: {
        async allTodoFromDatabase(context){
            await axios.get("api/todo")
                .then((response)=>{
                    context.commit("todo",response.data.todo)
                    context.commit("todoDrag",response.data.todoDrag)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },
        async removeTodoLeft({commit}, todo){
            await axios.delete("api/todo-delete/"+ todo.id)
                .then((response)=>{
                    commit("removeTodoLeft", todo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },
        async removeTodoRight({commit}, todo){
            await axios.delete("api/todo-delete/"+ todo.id)
                .then((response)=>{
                    commit("removeTodoRight", todo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },
        async completeTodo({commit}, todo){
            await axios.put("api/todo-edit/"+todo.id)
                .then((response)=>{
                    commit("completeToDo", todo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },
        async dragTodoRight({commit}, todo){
            await axios.put("api/todo-drag/"+todo.id)
                .then((response)=>{
                    commit("dragTodoRight", todo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },

        async dragTodoLeft({commit}, todo){
            await axios.put("api/todo-drag/"+todo.id)
                .then((response)=>{
                    commit("dragTodoLeft", todo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },
    },
    mutations: {

        todo(state, data) {
            return state.todo = data
        },

        todoDrag(state, data) {
            return state.todoDrag = data
        },

        createTodo(state, newTodo){
            axios.post("api/todo-store", newTodo)
                .then(response => {
                    newTodo.id = response.data.id
                    state.todo.unshift(newTodo)
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },

        removeTodoLeft(state, todo){
            state.todo.splice(state.todo.indexOf(todo), 1)
        },

        removeTodoRight(state, todo){
            state.todoDrag.splice(state.todoDrag.indexOf(todo), 1)
        },

        completeToDo(state, todo){
            todo.done = !todo.done
        },

        dragTodoRight(state, todo) {
            state.todo.splice(state.todo.indexOf(todo), 1)
            state.todoDrag.unshift(todo)
        },

        dragTodoLeft(state, todo) {
            state.todoDrag.splice(state.todoDrag.indexOf(todo), 1)
            state.todo.unshift(todo)
        },
    }
}
