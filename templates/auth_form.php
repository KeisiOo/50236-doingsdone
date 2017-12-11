<div class="modal">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Вход на сайт</h2>

  <form class="form" action="index.html" method="post">
    <div class="form__row">
      <?php $classname = isset($errors['email']) ? "form__input--error" : "";
      $value = isset($authUser['email']) ? $authUser['email'] : ""; ?>
      <label class="form__label" for="email">E-mail <sup>*</sup></label>

      <input class="form__input <?=$classname;?>" type="text" name="email" id="email" value="<?=$value;?>" placeholder="Введите e-mail">

      <p class="form__message"><?= isset($errors['email']) ? $errors['email'] : '' ?></p>
    </div>

    <div class="form__row">
      <?php $classname = isset($errors['password']) ? "form__input--error" : "";
      $value = isset($authUser['password']) ? $authUser['password'] : ""; ?>
      <label class="form__label" for="password">Пароль <sup>*</sup></label>

      <input class="form__input <?=$classname;?>" type="password" name="password" id="password" value="" placeholder="Введите пароль">
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="" value="Войти">
    </div>
  </form>
</div>