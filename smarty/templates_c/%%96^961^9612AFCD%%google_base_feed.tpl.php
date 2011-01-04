<?php /* Smarty version 2.6.18, created on 2009-03-14 23:14:07
         compiled from google_base_feed.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8" <?php echo '?>'; ?>


<rss version ="2.0" xmlns:g="http://base.google.com/ns/1.0">

<channel>
	<title>Houses and Apartments for Rent in Bloomington, Indiana</title>
	<description>Houses and apartments for rent in Bloomington, IN listed from IURentStop.com</description>
	<link>http://www.iurentstop.com</link>

<?php echo $this->_tpl_vars['items']; ?>


</channel>
</rss>