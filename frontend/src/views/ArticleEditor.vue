<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <h2 class="myProfile__heading">Create new article</h2>

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
        <h2 class="editor__section-heading">Add content</h2>

        <form action="" class="editor__inputForm editor__inputForm--article">
          <div class="inputForm__column">
            <div class="editor__inputForm-wrapper">
              <label class="editor__inputForm-label" for="title">Title</label>
              <input
                class="editor__inputForm-input"
                type="text"
                name="title"
                id="title"
                placeholder="Enter title here"
                required
              />
            </div>

            <div class="editor__inputForm-wrapper">
              <label class="editor__inputForm-label" for="content"
                >Content</label
              >
              <textarea
                class="editor__inputForm-input editor__inputForm-input--article-content"
                type="text"
                name="content"
                id="content"
                rows="5"
                cols="10"
                placeholder="Enter content of your article here"
                required
              />
            </div>
            <button class="btn__editor-page" @submit.prevent="updateUser">
              Create
            </button>
          </div>

          <div class="category">
            <label class="editor__inputForm-label" for="Tags">Tags</label>
            <button class="btn__add-category" @submit.prevent="chooseCategory">
              ADD TAG
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</template>

<script></script>
