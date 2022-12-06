<template>
  <div class="myProfile">
    <div class="myProfile__inner">
      <img :src="user.avatar_path" class="myProfile__image" alt="" />
      <h2 class="myProfile__heading">
        {{ user.name }}
      </h2>
      <p class="myProfile__content">
        {{ user.email }}
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
    user: {
      type: Object,
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
