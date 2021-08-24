<template>
    <div class="form">
        <input
            type="text"
            id="input"
            class="input"
            placeholder="Enter your todo"
            autocomplete="off"
            v-model="text"
            @keydown.enter="onAddNewTodo"
        />
    </div>
</template>
<script>
export default {
    props: {
        onAddNewTodo: {
            type: Function,
            required: true,
        },
    },
};
</script>