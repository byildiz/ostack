<?=form_open('users/register')?>
  <dl>
    <dt>Name:</dt>
    <dd>
      <input type="text" name="name" value="<?=set_value('name')?>"/>
      <?=form_error('name')?>
    </dd>
  </dl>
  <dl>
    <dt>E-mail:</dt>
    <dd>
      <input type="text" name="email" value="<?=set_value('email')?>"/>
      <?=form_error('email')?>
    </dd>
  </dl>
  <dl>
    <dt>Password:</dt>
    <dd>
      <input type="password" name="password" value="<?=set_value('password')?>"/>
      <?=form_error('password')?>
    </dd>
  </dl>
  <dl>
    <dt></dt>
    <dd><input type="submit" name="register" value="Register"/></dd>
  </dl>
</form>