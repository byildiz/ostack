<?=form_open('users/login')?>
  <dl>
    <dt>E-mail:</dt>
    <dd>
      <input type="text" name="email" value="<?=set_value('email')?>"/>
    </dd>
  </dl>
  <dl>
    <dt>Password:</dt>
    <dd>
      <input type="password" name="password" value="<?=set_value('password')?>"/>
    </dd>
  </dl>
  <?php if (isset($login_error)): ?>
  <dl>
    <dt></dt>
    <dd><p class="error">E-mail or password is incorrect.</p></dd>
  </dl>
  <?php endif; ?>
  <dl>
    <dt></dt>
    <dd><input type="submit" name="register" value="Register"/></dd>
  </dl>
</form>