<?php
/* Security measure */
if (!defined('IN_CMS')) { exit(); }
?>
<h1><?php echo __('Settings'); ?></h1>
<form action="<?php echo get_url('plugin/disable_filters/save'); ?>" method="post">
<fieldset style="padding: 0.5em;">
<legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Select the part for which you want to disable the filters'); ?></legend>
<?php foreach ($page_parts as $key => $part) : ?>
<label for="part_<?php echo $part->name; ?>">
<input id="part_<?php echo $part->name; ?>" type="checkbox" name="settings[]" value="<?php echo $part->name; ?>" <?php echo (is_array($settings) && in_array($part->name, $settings)  ? 'checked="checked"' : ''); ?>>
<span><?php echo $part->name; ?></span></label>
<?php endforeach; ?>
</fieldset>
<p class="buttons">
<input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
</p>
</form>
<script type="text/javascript">
// <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }

    function unloadMessage() {
        return '<?php echo __('You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }

    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });
// ]]>
</script>