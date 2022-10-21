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

        <div class="devider"></div>

        <p>
          <RouterLink class="myProfile__link" to="/my-profile">
            Back to profile</RouterLink
          >
        </p>
      </div>
    </div>

    <div class="section">
      <div class="section__inner section__inner--editor">
        <h2 class="editor__section-heading">Edit Profile</h2>

        <form action="" class="editor__inputForm">
          <div class="editor__inputForm-wrapper">
            <label class="editor__inputForm-label" for="email">Email</label>
            <input
              class="editor__inputForm-input"
              type="text"
              name="email"
              id="email"
              placeholder="your@email.com"
              required
            />
          </div>

          <div class="editor__inputForm-wrapper">
            <label class="editor__inputForm-label" for="name">Name</label>
            <input
              class="editor__inputForm-input"
              type="text"
              name="name"
              id="name"
              placeholder="Name"
              required
            />
          </div>

          <div class="editor__inputForm-wrapper">
            <label class="editor__inputForm-label" for="slug">Slug</label>
            <input
              class="editor__inputForm-input"
              type="text"
              name="slug"
              id="slug"
              placeholder="Slug"
              required
            />
          </div>

          <div class="editor__inputForm-wrapper">
            <label class="editor__inputForm-label" for="password"
              >Password</label
            >
            <input
              class="editor__inputForm-input"
              type="password"
              name="password"
              id="password"
              placeholder="********"
              required
            />
          </div>

          <div class="editor__inputForm-wrapper">
            <label class="editor__inputForm-label" for="password"
              >Repeat password</label
            >
            <input
              class="editor__inputForm-input"
              type="password"
              name="password"
              id="password"
              placeholder="********"
              required
            />
          </div>

          <button class="btn__editor-page" @submit.prevent="updateUser">
            Update
          </button>
        </form>
      </div>
    </div>
  </main>
</template>

<script></script>
