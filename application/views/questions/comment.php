<?=form_open($formAction)?>
  <dl>
    <dt>Comment <?=$commentTitle?>:</dt>
    <dd>
      <textarea name="text"><?=set_value('text')?></textarea>
      <?=form_error('text')?>
    </dd>
  </dl>
  <dl>
    <dt></dt>
    <dd><input type="submit" name="comment" value="Comment"/></dd>
  </dl>
</form>