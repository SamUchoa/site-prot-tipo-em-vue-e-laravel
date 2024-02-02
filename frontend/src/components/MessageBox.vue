<script>
export default {
  props: {
    message: {
      type: String,
      required: true,
      default: null,
    },
    error: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    isError() {
      if (this.error == true) {
        return "error-message";
      }
      return "success-message";
    },
  },
};
</script>

<template>
  <div :class="['message', isError]">{{ message }}</div>
</template>

<style scoped>
.message {
  padding: 0.25em 2em;
  position: fixed;
  top: 80%;
  right: auto;
  background-color: green;
}
</style>
