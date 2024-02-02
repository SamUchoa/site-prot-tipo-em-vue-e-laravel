<script>
export default {
  props: {
    inputType: { type: String, default: "text" },
    inputPlaceholder: { type: String },
    faIconClass: { type: String },
    inputLabel: { type: String },
    modelValue: { type: String },
  },
};
</script>

<template>
  <div class="flexWraper">
    <span class="icon elementSize"
      ><i :class="faIconClass" class="color"></i
    ></span>
    <input
      class="input elementSize"
      :placeholder="inputPlaceholder"
      :type="inputType"
      :id="inputLabel"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <label class="input-label" :for="inputLabel">{{ inputLabel }}</label>
  </div>
</template>

<style scoped>
.flexWraper {
  display: flex;
  align-items: center;
}
.elementSize {
  font-size: 0.75em;
}
.icon {
  position: absolute;
  padding-left: 0.5em;
}
.color {
  color: var(--grey);
}
input {
  border: 0.05em solid var(--grey);
  border-radius: 0.1rem;
  padding: 0.75em 2em;
  width: 100%;
}
input:focus {
  outline: 1px solid var(--grey);
}
.input-label {
  display: none;
}
</style>
