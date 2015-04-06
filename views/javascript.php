<script type="text/javascript">
// <![CDATA[
$(function() {
    $("div#part-tabs ul.tabNavigation a").each(function() {
        var part_names = <?php echo $parts; ?> ;
        var part_id = $(this).attr('href').replace(/\D/g, '');
        var el = $(this).text();

        if (part_names && part_id) {
            if (jQuery.inArray(el, part_names) > -1) {
                $("#part-" + part_id).find('select').children('option:not(:first)').remove();
                $("#part-" + part_id).find('select').change();
            }
        }
    });
});
// ]]>
</script>