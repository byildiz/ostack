<?=form_open('ask')?>
  <dl>
    <dt>Question Title:</dt>
    <dd>
      <input type="text" name="title" value="<?=set_value('title')?>"/>
      <?=form_error('title')?>
    </dd>
  </dl>
  <dl>
    <dt>Question Explanation:</dt>
    <dd>
      <textarea name="text"><?=set_value('text')?></textarea>
      <?=form_error('text')?>
    </dd>
  </dl>
  <dl>
    <dt>Question Tags:</dt>
    <dd>
      <input type="text" name="tags" value="<?=set_value('tags')?>"/>
      <span class="tip">Tags should be seperated by comma.</span>
      <?=form_error('tags')?>
    </dd>
  </dl>
  <dl>
    <dt></dt>
    <dd><input type="submit" name="ask" value="Ask"/></dd>
  </dl>
</form>