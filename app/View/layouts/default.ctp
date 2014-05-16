<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="alternate" type="application/rss+xml" title="Naxasius news feed" href="<?php echo $this->Html->url('/news/rss/'); ?>" />
<title><?php echo $title_for_layout; ?></title>
<meta name="description" content="<?php echo $description_for_layout; ?>" />
<link href="<?php echo $this->Html->url('/favicon.ico'); ?>" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript">var url = '<?php echo $this->Html->url('/'); ?>';var interface = '<?php echo Configure::read('Game.interface'); ?>';</script>
<?php
echo $this->Html->script(array_merge(array('j.js', 'website.js', 'j.borders.js', 'game/item.js'), $javascripts));
echo $this->Html->css(array_merge(array('reset.css','website.css'), $styles));
?>
<link rel="browser-game-info" href="<?php echo $this->Html->url('/pages/browsergamehub', true); ?>" />
</head>
<body>
<div class="c">
	<div class="content_c">
		<div class="crumbs_c">
		<?php foreach($crumbs as $index => $crumb) { if($index < count($crumbs)-1){ echo '<span class="crumb">'. $this->Html->link($crumb['name'], $crumb['link']) .' ::</span>'; } else { echo '<span class="crumb selected">'. $crumb['name'] .'</span>'; } } ?>
		</div>
		<div class="content" id="content"><?php echo $this->Session->flash(); echo $content_for_layout; ?></div>
	</div>
	<div class="menu_c">
		<div class="menu"><?php echo $this->Html->link(__('Home'), '/', array('class' => 'nostyle')); ?></div>
		<div class="menu"><?php echo $this->Html->link(__('Media'), '/screenshots', array('class' => 'nostyle')); ?></div>
		<?php
		if(isset($pages) && is_array($pages)) {
			foreach($pages as $page) {
			?>
			<div class="menu"><?php echo $this->Html->link(__($page['Page']['name']), '/pages/view/'. $page['Page']['id'], array('class' => 'nostyle')); ?></div>
			<?php
			}
		}
		?>
		<div class="menu"><?php echo $this->Html->link(__('Forum'), '/forum', array('class' => 'nostyle')); ?></div>
	</div>
	<div class="footer_c">
		&copy; <?php echo date('Y'); ?> <?php echo $this->Html->link('Fellicht.nl', 'http://www.fellicht.nl'); ?> | <?php echo $this->Html->link(__('General Conditions', true), '/pages/view/7'); ?>
	</div>
</div>
<div class="login_c">
	<div class="login">
	<?php
	if(isset($userInfo['id']) && !empty($userInfo['id'])) {
		?>
		<h1><?php __('Welcome back'); ?></h1>
		<p><?php __('You are logged in as:'); ?> <?php echo $userInfo['username']; ?><br />
		<?php
		if($userInfo['role'] == 'admin') {
			echo $this->Html->link(__('Admin', true), '/admin');
		}
		else {
			if(empty($userInfo['activation_code'])) {
				echo $this->Html->link(__('Play!', true), '/characters');
			}
			else {
				echo $this->Html->link(__('Activate account', true), '/users/activate');
			}
		}
		?>
		<?php echo $this->Html->link(__('Logout', true), '/users/logout'); ?>
		</p>
		<?php
	}
	else {
	?>
		<?php echo $this->Form->create('User', array('url' => '/users/login')); ?>
		<h1><?php __('Login'); ?></h1>
		<?php echo $this->Form->input('User.username', array('error' => false, 'value' => '', 'label' => false, 'div' => false, 'title' => __('Username', true))); ?>
		<?php echo $this->Form->input('User.password', array('error' => false, 'value' => '', 'label' => false, 'div' => false, 'title' => __('Password', true))); ?>
		<?php echo $this->Form->end(array('label' => __('Login', true), 'div' => false)); ?>
		<p><?php echo $this->Html->link(__('Forgot password?', true), '/users/lostpw'); ?> /
		<?php echo $this->Html->link(__('Register', true), '/users/register'); ?></p>
	<?php
	}
	?>
	</div>
</div>
<div id="mouseInfo"></div>
<?php echo $this->Html->link($this->Html->image('/img/website/layout/naxasius-browser-game.png', array('id' => 'logo', 'title' => __('Back to homepage', true))), '/', array('escape' => false, 'class' => 'nostyle')); ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>