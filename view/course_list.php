<main class="main">
  <?php if($courses): ?>
    <section id="list" class="list">
      <header class="list__row list__header">
        <h1>Course List</h1>
      </header>
      <?php foreach($courses as $course): ?>
        <div class="list__row">
          <div class="list__item">
            <p class="bold"><?= $course['name'] ?></p>
          </div>
          <div class="list__removeItem">
            <form action="." method="POST">
              <input type="hidden" name="action" value="delete_course" />
              <input type="hidden" name="course_id" value="<?= $course
              ['id'] ?>" />
              <button class="remove-button" title="delete this course" aria-label="delete this course">❌</button>
            </form> 
          </div>
        </div>
      <?php endforeach ?>
    </section>
  <?php else: ?>
    <p>No courses exist yet...</p>
  <?php endif ?>
  <section class="add mb-1" id="add">
    <h2>Add Course</h2>
    <form action="." method="POST" id="add__form" class="add__form">
      <input type="hidden" name="action" value="add_course">
      <div class="add__inputs">
        <label for="course_name">Name: </label>
        <input type="text" name="course_name" id="course_name" maxlength="50" placeholder="Name" autofocus required />
      </div>
      <div class="add__item">
        <button class="add-button bold">Add</button>
      </div>
    </form>
  </section>
  <p><a href=".">View &amp; Add Assignments</a></p>
</main>