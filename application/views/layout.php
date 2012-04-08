<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>OStack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Open source stackoverflow">
    <meta name="author" content="Burak YILDIZ">
    
    <link rel="stylesheet" href="<?=base_url('assets/css/reset.css')?>" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('assets/css/ostack.css')?>" type="text/css" />
  </head>

  <body>
    <div id="page">
      <div id="header">
        <span class="logo">OStack</span>
        <span id="pages">
          <?=anchor('questions', 'Questions')?>
          <?=anchor('tags', 'Tags')?>
          <?=anchor('users', 'Users')?>
        </span>
      </div>
      <div id="tabs"></div>
      <div id="content"><?=$content_for_layout?></div>
      <div id="footer">OpenStack @CopyLeft</div>
    </div>
  </body>
</html>