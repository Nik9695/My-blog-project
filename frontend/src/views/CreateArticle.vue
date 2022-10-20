<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <h2 class="myProfile__heading">Create new article</h2>

        <p>
          <RouterLink class="myProfile__link" to="/my-profile">
            Back to profile</RouterLink
          >
        </p>
      </div>
    </div>

    <div class="section">
      <div class="section__inner section__inner--editProfile__page">
        <h2 class="editMyProfile__section-heading">Add content</h2>

        <form action="" class="editMyProfile__inputForm">
          <div class="editMyProfile__inputForm-wrapper">
            <label for="email">Title</label>
            <input type="text" name="email" id="email" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="name">Slug</label>
            <input type="text" name="name" id="name" required />
          </div>

          <div class="editMyProfile__inputForm-wrapper">
            <label for="slug">Content</label>
            <input type="text" name="slug" id="slug" required />
          </div>

          <div class="btn__update">
            <input type="submit" value="Create" />
          </div>
        </form>
      </div>

      <div class="btn__update">
        <input type="submit" value="ADD TAG" />
      </div>
    </div>
  </main>
</template>
