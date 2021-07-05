<template>
    <div class="item">
        <input
            type="checkbox"
            v-on:change="updateCheck(item.id)"
            v-model="item.completed"
        />
        <span v-bind:class="[item.completed ? 'completed' : '', 'itemText']"> {{ item.name }} </span>
        <button v-on:click="removeItem(item.id)" class="trashButton">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props: ['item'],
    methods: {
        updateCheck(id) {
            axios.put(`api/item/${id}`, {
                completed: this.item.completed
            })
            .then(response => {
                if (response.status === 200) {
                    this.$emit("itemchanged")
                }
            })
            .catch(error => {
                console.error(error)
            })

        },
        removeItem(id) {
            axios.delete(`api/item/${id}`)
            .then(response => {
                if (response.status === 204) {
                    this.$emit('itemchanged')
                }
            })
            .catch(error => {
                console.error(error)
            })
        }
    }

}
</script>

<style scoped>
.itemText {
    width: 100%;
    margin-left: 20px;
}

.item {
    display: flex;
    justify-content: center;
    align-items: center;
}

.completed {
    text-decoration: line-through;
    color: #999999;
}

.trashButton {
    cursor: pointer;
    background: #e6e6e6;
    border:none;
    color: red;
    outline: none;
}
</style>
