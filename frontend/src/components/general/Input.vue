<template>
  <div class="register__inputWrapper">
    <div class="register__error" v-if="errors[name]">
      {{ errors[name][0] }}
    </div>
    <label :for="name" class="register__label">{{ lable }}</label>
    <input
      v-model="inputValue"
      class="register__input"
      :type="type"
      :name="name"
      :placeholder="placeholder"
      :class="{ 'register__input--error': errors[name] }"
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
