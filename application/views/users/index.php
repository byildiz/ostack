<?=anchor('users?sort=reputation', 'Sort by reputation')?>,
<?=anchor('users?sort=newest', 'Sort by date')?>
<?php foreach ($users as $u): ?>
<table>
  <tr>
  	<td class="width100">
      <span class="bold">Reputation:</span> <?=($u->reputation) ? $u->reputation : 0?><br/>
      <span class="bold">Question:</span> <?=$u->question_count?><br/>
      <span class="bold">Answer:</span> <?=$u->answer_count?><br/>
      <span class="bold">Comment:</span> <?=$u->comment_count?>
    </td>
  	<td>
      <div class="text"><?=anchor('users/'.$u->uid, $u->name)?></div>
      <div>
        <span class="bold">E-mail:</span> <?=$u->name?>,
        <span class="bold">Register:</span> <?=mysql2date($u->created)?>
      </div>
    </td>
  </tr>
</table>
<?php endforeach; ?>