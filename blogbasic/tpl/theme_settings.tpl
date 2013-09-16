<link rel="stylesheet" media="screen" type="text/css" href="/view/theme/blogbasic/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="/view/theme/blogbasic/colorpicker/js/colorpicker.js"></script>
<script>
$(document).ready(function() {
	$('#id_blogbasic_linkcolour, #id_blogbasic_asect, #id_blogbasic_astext').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
});
</script>

{{include file="field_select.tpl" field=$font_size}}

{{include file="field_input.tpl" field=$background}}

{{include file="field_select.tpl" field=$line_height}}

{{include file="field_select.tpl" field=$navcolour}}

{{include file="field_input.tpl" field=$linkcolour}}

{{include file="field_input.tpl" field=$radius}}

{{include file="field_input.tpl" field=$asect}}

{{include file="field_input.tpl" field=$asectopacity}}

{{include file="field_input.tpl" field=$astext}}

{{include file="field_select.tpl" field=$shadow}}

<div class="settings-submit-wrapper">
	<input type="submit" value="{{$submit}}" class="settings-submit" name="blogbasic-settings-submit" />
</div>
