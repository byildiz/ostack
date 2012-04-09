<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>OStack</title>
    <meta name="description" content="Open source stackoverflow">
    <meta name="author" content="Burak YILDIZ">
    
    <!--
    <link rel="stylesheet" href="<?=base_url('assets/css/reset.css')?>" type="text/css" />
    -->
    <link rel="stylesheet" href="<?=base_url('assets/css/ostack.css')?>" type="text/css" />
  </head>

  <body>
    <div id="page">
      <div id="header">
        <div id="session">
          <?php if (($user = $this->User_model->isLoged()) !== false): ?>
          <?=anchor('ask', 'Ask a question')?> -
          <?=$user->name?>,
          <?=anchor('users/logout', 'Logout')?>
          <?php else: ?>
          <?=anchor('users/logout', 'Login')?> or <?=anchor('users/register', 'Register')?>
          <?php endif; ?>
        </div>
        <span class="logo">OStack</span>
        <span id="pages">
          <?=anchor('questions', 'Questions')?>
          <?=anchor('tags', 'Tags')?>
          <?=anchor('users', 'Users')?>
        </span>
      </div>
      <div id="content"><?=$content_for_layout?></div>
      <div id="footer">OpenStack <span class="copyleft">&copy;</span> 2012</div>
    </div>
  </body>
</html>