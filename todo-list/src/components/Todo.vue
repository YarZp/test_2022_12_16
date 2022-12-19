<template>
  <div class="todo__wrapper">
    <div class="todo">
      <h1>Todo App</h1>
      <div class="todo__add">
        <input type="text" v-model="todo" placeholder="tap your todo here..."/>
        <button @click="addTodo">Add</button>
      </div>
      <div class="todo__list" v-if="todos.length" >
        <div class="todo__item" :class="{active: todo.complete}" v-for="(todo, index) in todos" :key="todo.id" >
          <span @click="markTask(todo, index)">{{todo.title}}</span>
          <button @click="removeTodo(todo, index)">X</button>
        </div>
      </div>
      <div v-else>come on! add your new todo</div>
    </div>
  </div>
</template>

<script>
import {createTask, getAllTasks, editTask, deleteTask} from '../services/api';
export default {
  name: 'todoList',
  data() {
    return{
      todo: '',
      todos: [],
    }
  },
  async mounted() {
    this.todos = await getAllTasks();
    console.log(this.todos, 'this.todos');
  },
  methods: {
     async addTodo(){
      try {
        this.todos.push(await createTask({title: this.todo}));
        if(this.todos.length > 2){
          this.markTask(this.unfinishedTodos[0], 0)
          // this.unfinishedTodos[0].complete = !this.unfinishedTodos[0].complete
        }
      }
      catch (e) {
        console.log(e);
      }
    },
    async markTask(task, index){
      this.todos[index] = await editTask(task.id, {...task, ...{complete: !task.complete}});
    },
    removeTodo(task, index){
      try {
        deleteTask(task.id).then(() => {
          this.todos.splice(index, 1);
        })
      }
      catch (e){
        console.log(e);
      }
      // this.todos = this.todos.filter((todo) => todo.id !== todoId);
    }
  },
  computed: {
    // finishedTodos() {return this.todos.filter(todo => todo.complete)},
    unfinishedTodos() {return this.todos.filter(todo => !todo.complete)}

  }
}
</script>

