<div class="modal">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Добавление задачи</h2>

  <form class="form" enctype="multipart/form-data" action="index.php" method="post">
    <div class="form__row">
      <?php $classname = isset($errors['name']) ? "form__input--error" : "";
      $value = isset($newTask['task']) ? $newTask['task'] : ""; ?>
      <label class="form__label" for="name">Название <sup>*</sup></label>

      <input class="form__input <?=$classname;?>" type="text" name="name" id="name" value="<?=$value;?>" placeholder="Введите название">
    </div>

    <div class="form__row">
      <?php $classname = isset($errors['project']) ? "form__input--error" : "";
      $value = isset($newTask['category']) ? $newTask['category'] : ""; ?>
      <label class="form__label" for="project">Проект <sup>*</sup></label>

      <select class="form__input form__input--select" name="project" id="project">
        <option value="">Входящие</option>
      </select>
    </div>

    <div class="form__row">
      <?php $classname = isset($errors['date']) ? "form__input--error" : "";
      $value = isset($newTask['date']) ? $newTask['date'] : ""; ?>
      <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>

      <input class="form__input form__input--date <?=$classname;?>" type="date" name="date" id="date" value="<?=$value;?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
    </div>

    <div class="form__row">
      <label class="form__label" for="preview">Файл</label>

      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="preview" id="preview" value="">

        <label class="button button--transparent" for="preview">
            <span>Выберите файл</span>
        </label>
      </div>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="add-project" value="Добавить">
    </div>
  </form>
</div>