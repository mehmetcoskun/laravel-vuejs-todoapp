<template>
    <div>
        <h1>todos</h1>
        <AddSection :onAddNewTodo="onAddNewTodo" />
        <ListSection
            :todoList="todoList.sort().reverse()"
            :onChangeStatus="onChangeStatus"
            :onDelete="onDelete"
        />
        <small class="small"
            >Left click on the todo to mark as complete. <br />
            Right click on the todo to delete it.</small
        >
    </div>
</template>

<script>
import axios from "axios";

import AddSection from "./components/AddSection";
import ListSection from "./components/ListSection";

export default {
    components: {
        AddSection,
        ListSection,
    },
    data() {
        return {
            text: null,
            todoList: [],
        };
    },
    mounted() {
        axios.get("http://localhost:8000/api/todo").then((response) => {
            this.todoList = response.data || [];
        });
    },
    methods: {
        onAddNewTodo(e) {
            axios
                .post("http://localhost:8000/api/todo/add", {
                    text: e.target.value,
                })
                .then((response) => {
                    this.todoList.push(response.data);
                    e.target.value = "";
                    e.target.focus();
                });
        },
        onChangeStatus(e, todo) {
            e.preventDefault();

            axios
                .post("http://localhost:8000/api/todo/update", {
                    id: todo.id,
                })
                .then((response) => {
                    if (response.data.status == true) {
                        var selectedItem = this.todoList.find(
                            (item) => item.id == todo.id
                        );

                        selectedItem.status =
                            selectedItem.status == "1" ? "0" : "1";
                    }
                });
        },
        onDelete(e, todo) {
            e.preventDefault();

            axios
                .post(`http://localhost:8000/api/todo/delete`, {
                    id: todo.id,
                })
                .then((response) => {
                    if (response.data.status == true) {
                        this.todoList = this.todoList.filter(
                            (item) => item.id != todo.id
                        );
                    }
                });
        },
    },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");

* {
    box-sizing: border-box;
}

body {
    background-color: #f5f5f5;
    margin: 0;
    font-family: "Poppins", sans-serif;
    display: flex;
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    color: #444;
}

h1 {
    text-align: center;
    color: rgb(175, 135, 214);
    font-size: 6rem;
    opacity: 0.4;
    margin: 0;
}

.form {
    max-width: 100%;
    width: 500px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.input {
    width: 100%;
    display: block;
    padding: 0.6rem 2rem;
    font-size: 2rem;
    border: none;
    color: #444;
}
.input::placeholder {
    color: #d5d5d5;
}

.todos {
    background-color: white;
    padding: 0;
    margin: 0;
    list-style-type: none;
}

.todos li {
    font-size: 1.5rem;
    padding: 1rem 2rem;
    border-top: 1px solid #f5f5f5;
    cursor: pointer;
}

.todos li.completed {
    text-decoration: line-through;
    color: #b5b5b5;
}

.small {
    margin-top: 2rem;
    color: #b5b5b5;
    text-align: center;
    display: flex;
    justify-content: center;
}
</style>