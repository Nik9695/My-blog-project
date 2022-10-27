<template>
  <div class="myProfile">
    <div class="myProfile__inner">
      <img
        src="@/assets/images/default-user-icon.png"
        class="myProfile__image"
      />
      <h2 class="myProfile__heading">
        {{ name }}
      </h2>
      <p class="myProfile__content">
        {{ email }}
      </p>
      <div class="devider"></div>
      <p>
        <RouterLink class="myProfile__link" :to="link">
          {{ linkLabel }}</RouterLink
        >
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    email: {
      type: String,
      required: true
    },
    link: {
      type: String,
      required: true
    },
    linkLabel: {
      type: String,
      required: true
    }
  }
}
</script>
