<div class="title"><?=$question->title?></div>
<hr/>
<table>
  <tr>
  	<td class="width100">
      <?=anchor('questions/vote_question/up/'.$question->qid, 'up')?><br/>
      <?=$question->vote_count?><br/>
      <?=anchor('questions/vote_question/down/'.$question->qid, 'down')?>
    </td>
  	<td>
      <div class="text"><?=$question->text?></div>
      <div>
        <span class="bold">Tags:</span>
        <?php foreach ($tags as $t): ?>
        <?=$t->text?>,
        <?php endforeach; ?>
      </div>
      <div class="right">
        <span class="bold">User:</span> <?=$question->name?>,
        <span class="bold">Date:</span> <?=mysql2date($question->created)?>
      </div>
    </td>
  </tr>
  <tr>
  	<td></td>
  	<td>
      <ul>
        <?php foreach ($question->comments as $c): ?>
        <li>
          <?=$c->text?> - <?=$c->name?>, <?=mysql2date($c->created)?>, <?=anchor('questions/comment_comment/'.$c->cid.'/'.$question->qid, 'Comment on comment')?>
          <ul>
            <?php foreach ($this->Comment_model->getCommentComments($c->cid) as $cc): ?>
          	<li><?=$cc->text?> - <?=$cc->name?>, <?=mysql2date($cc->created)?></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endforeach; ?>
        <li><?=anchor('questions/comment_question/'.$question->qid, 'Comment on question')?></li>
      </ul>
    </td>
  </tr>
</table>
<div class="title">Answers</div>
<hr/>
<?php foreach ($answers as $a): ?>
<table>
  <tr>
  	<td class="width100">
      <?=anchor('questions/vote_answer/up/'.$a->aid, 'up')?><br/>
      <?=$a->vote_count?><br/>
      <?=anchor('questions/vote_answer/down/'.$a->aid, 'down')?>
    </td>
  	<td>
      <div class="text"><?=$a->text?></div>
      <div class="right">
        <span class="bold">User:</span> <?=$a->name?>,
        <span class="bold">Date:</span> <?=mysql2date($a->created)?>
      </div>
    </td>
  </tr>
  <tr>
  	<td></td>
  	<td>
      <ul>
        <?php foreach ($a->comments as $c): ?>
        <li>
          <?=$c->text?> - <?=$c->name?>, <?=mysql2date($c->created)?>, <?=anchor('questions/comment_comment/'.$c->cid.'/'.$question->qid, 'Comment on comment')?>
          <ul>
            <?php foreach ($this->Comment_model->getCommentComments($c->cid) as $cc): ?>
          	<li><?=$cc->text?> - <?=$cc->name?>, <?=mysql2date($cc->created)?></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endforeach; ?>
        <li><?=anchor('questions/comment_answer/'.$a->aid.'/'.$question->qid, 'Comment on answer')?></li>
      </ul>
    </td>
  </tr>
</table>
<?php endforeach; ?>
<div class="title">Your Answer</div>
<hr/>
<?=form_open('questions/answer/'.$question->qid)?>
  <dl>
  	<dt></dt>
  	<dd>
      <textarea name="text"><?=set_value('text')?></textarea>
      <?=form_error('text')?>
    </dd>
  </dl>
  <dl>
  	<dt></dt>
  	<dd><input type="submit" name="send" value="Send"/></dd>
  </dl>
</form>