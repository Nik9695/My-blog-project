<template>
  <div class="myProfile">
    <div class="myProfile__inner">
      <h2 class="myProfile__heading">{{ title }}</h2>

      <div class="devider"></div>

      <p>
        <RouterLink class="myProfile__link" to="/my-profile">
          Back to profile</RouterLink
        >
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>
