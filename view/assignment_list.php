<main class="main">
  <section id="list" class="list">
    <header class="list__row list__header">
      <h1>Assignments</h1>
      <form action="." method="POST" class="list__header__select" id="list__header__select">
        <input type="hidden" name="action" value="list_assignments" />
        <select name="course_id" required>
          <option value="0">View All</option>
          <?php foreach($courses as $course): ?>
            <?php if($course["id"] == $course_id): ?>
              <option value="<?= $course["id"] ?>" selected><?= $course["name"] ?></option>
            <?php else: ?>
              <option value="<?= $course["id"] ?>"><?= $course["name"] ?></option>
            <?php endif ?>
          <?php endforeach; ?>
        </select>
        <button class="add-button bold">Go</button>
      </form>
    </header>
    <?php if($assignments): ?>
      <?php foreach($assignments as $assignment): ?>
        <div class="list__row">
          <div class="list__item">
            <p class="bold"><?= $assignment["course_name"] ?></p>
            <p><?= $assignment["assignment_description"] ?></p>
          </div>
          <div class="list__removeItem">
            <form action="." method="POST">
              <input type="hidden" name="action" value="delete_assignment" />
              <input type="hidden" name="assignment_id" value="<?= $assignment
              ['assignment_id'] ?>" />
              <button class="remove-button" title="delete this assignment" aria-label="delete this assignment">❌</button>
            </form>
          </div>
        </div>
      <?php endforeach;?>
    <?php else: ?>
      <p><?= isset($course_id) ? 'No assignment exists for this course yet' : 'No assignment exits yet' ?></p>
    <?php endif ?>
  </section>
  <section class="add mb-1" id="add">
    <h2>Add Assignment</h2>
    <form action="." method="POST" id="add__form" class="add__form">
      <input type="hidden" name="action" value="add_assignment" />
      <div class="add__inputs"> 
        <label for="course_id">Course</label>
        <select name="course_id" id="course_id" required>
          <option value="">Please Select</option>
          <?php foreach($courses as $course): ?>
            <option value="<?= $course['id'] ?>"><?= $course["name"] ?></option>
          <?php endforeach ?>
        </select>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" maxlength="120" placeholder="Description" required />
      </div>
      <div class="add__addItem">
        <button class="add-button bold">Add</button>
      </div>
    </form>
  </section>
  <p><a href=".?action=list_courses">View/Edit Courses</a></p>
</main>