<div class="settings-submit-wrapper">
	<input type="submit" value="{{$submit}}" class="settings-submit" name="redbasic-settings-submit" />
</div>

{{if $expert}}
{{include file="field_checkbox.tpl" field=$narrow_navbar}}
{{include file="field_input.tpl" field=$banner_colour}}
{{include file="field_input.tpl" field=$link_colour}}
{{include file="field_input.tpl" field=$bgcolour}}
{{include file="field_input.tpl" field=$background_image}}
{{include file="field_input.tpl" field=$item_colour}}
{{include file="field_input.tpl" field=$item_opacity}}
{{include file="field_input.tpl" field=$body_font_size}}
{{include file="field_input.tpl" field=$font_size}}
{{include file="field_input.tpl" field=$font_colour}}
{{include file="field_input.tpl" field=$radius}}
{{include file="field_input.tpl" field=$shadow}}
{{include file="field_input.tpl" field=$top_photo}}
{{include file="field_input.tpl" field=$reply_photo}}
{{include file="field_checkbox.tpl" field=$sloppy_photos}}
<div class="settings-submit-wrapper">
	<input type="submit" value="{{$submit}}" class="settings-submit" name="redbasic-settings-submit" />
</div>
{{/if}}
