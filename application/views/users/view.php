<table>
  <tr>
  	<td class="width100">
      <span class="bold">Reputation:</span> <?=($user->reputation) ? $user->reputation : 0?><br/>
      <span class="bold">Question:</span> <?=$user->question_count?><br/>
      <span class="bold">Answer:</span> <?=$user->answer_count?><br/>
      <span class="bold">Comment:</span> <?=$user->comment_count?>
    </td>
  	<td>
      <div class="text"><?=anchor('users/'.$user->uid, $user->name)?></div>
      <div>
        <span class="bold">E-mail:</span> <?=$user->name?>,
        <span class="bold">Register:</span> <?=mysql2date($user->created)?>
      </div>
    </td>
  </tr>
</table>