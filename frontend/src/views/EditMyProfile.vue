<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <img
          src="@/assets/images/default-user-icon.png"
          class="myProfile__image"
        />
        <h2 class="myProfile__heading">Test User</h2>
        <p class="myProfile__content">email</p>

        <p>
          <RouterLink class="myProfile__editProfile-link" to="/my-profile">
            Back to profile</RouterLink
          >
        </p>
      </div>
    </div>

    <div class="section">
      <div class="section__inner section__inner--editProfile__page">
        <h2 class="editMyProfile__section-heading">Edit Profile</h2>

        <form action="" class="editMyProfile__inputForm">
          <div class="editMyProfile__inputForm-wrapper">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="password">Repeat password</label>
            <input type="password" name="password" id="password" required />
          </div>

          <div class="btn__update">
            <input type="submit" value="Update" />
          </div>
        </form>
      </div>
    </div>
  </main>
</template>
