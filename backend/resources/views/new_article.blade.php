<!DOCTYPE html>
<h1> Create new article </h1>

<form action="/new_article" method="post">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title">

    <br>

    <label for="content">Content</label>
    <input type="text" name="content" id="content">

    <br>

    <button type="submit">Submit</button>
</form>
