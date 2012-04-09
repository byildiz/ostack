<?=form_open('tags')?>
  <input type="text" name="text" value="<?=set_value('text')?>"/>
  <input type="submit" name="search" value="Search"/>
  <?=form_error('text')?>
</form>
<?php if (!empty($questions)): ?>
<?php foreach ($questions as $q): ?>
<table>
  <tr>
  	<td class="width100">
      <span class="bold">Vote:</span> <?=$q->vote_count?><br/>
      <span class="bold">Answer:</span> <?=$q->answer_count?><br/>
      <span class="bold">Comment:</span> <?=$q->comment_count?>
    </td>
  	<td>
      <div class="text"><?=anchor('questions/'.$q->qid, $q->title)?></div>
      <div>
        <span class="bold">Tags:</span>
        <?php foreach ($q->tags as $t): ?>
        <?=$t->text?>,
        <?php endforeach; ?>
      </div>
      <div class="right">
        <span class="bold">User:</span> <?=$q->name?>,
        <span class="bold">Date:</span> <?=mysql2date($q->created)?>
      </div>
    </td>
  </tr>
</table>
<?php endforeach; ?>
<?php endif; ?>