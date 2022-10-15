<template>
  <div class="inputForm__inputWrapper">
    <div class="inputForm__error" v-if="errors[name]">
      {{ errors[name][0] }}
    </div>
    <label :for="name" class="inputForm__label">{{ lable }}</label>
    <input
      v-model="inputValue"
      class="inputForm__input"
      :type="type"
      :name="name"
      :placeholder="placeholder"
      :class="{ 'inputForm__input--error': errors[name] }"
    />
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    lable: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'text'
    },
    placeholder: {
      type: String,
      default: 'text'
    },

    errors: {
      type: Object,
      default: () => ({})
    }
  },
  computed: {
    inputValue: {
      get() {
        return this.modelValue
      },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    }
  }
}
</script>
