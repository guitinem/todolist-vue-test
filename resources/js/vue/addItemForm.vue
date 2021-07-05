<template>
  <div class="addItem">
    <input type="text" v-model="item.name" />
    <font-awesome-icon
      icon="plus-square"
      v-on:click="addItem()"
      v-bind:class="[item.name ? 'active' : 'inactive', 'plus']"
      class="IconAddButton"
    />
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    addItem: function () {
      if (this.item.name == "") {
        return;
      }

      axios.post('api/item/store', {
          name: this.item.name
      })
      .then(response => {
          if (response.status === 201) {
              this.item.name = ""
              this.$emit('reloadlist')
          }
      })
      .catch(errors => {
          console.error(errors)
      })
    },
  },
};
</script>

<style scoped>
.addItem {
  display: flex;
  justify-content: center;
  align-items: center;
}

.IconAddButton {
    cursor: pointer;
}

input {
  background: #f7f7f7;
  border: 0px;
  outline: none;
  padding: 5px;
  margin-right: 10px;
  width: 100%;
}

.active {
  color: chartreuse;
}

.inactive {
  color: darkgray;
}
</style>
