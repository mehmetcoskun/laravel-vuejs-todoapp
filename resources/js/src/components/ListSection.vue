<template>
    <ul class="todos" id="todos">
        <li
            v-for="todo in todoList"
            :key="todo.id"
            @click="onChangeStatus($event, todo)"
            @contextmenu="onDelete($event, todo)"
            :class="todo.status == 0 && 'completed'"
        >
            {{ todo.text }}
        </li>
    </ul>
</template>
<script>
export default {
    props: {
        todoList: {
            type: Object,
            required: false,
        },
        onChangeStatus: {
            type: Function,
            required: true,
        },
        onDelete: {
            type: Function,
            required: true,
        },
    },
};
</script>