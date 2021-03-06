<?php

/**
 * Are you human?
 *
 * @author  emanuele
 * @license BSD http://opensource.org/licenses/BSD-3-Clause
 *
 * @version 0.0.2
 *
 */

function template_control_verification_areyouhuman($verify_id, $verify_context)
{
	global $context, $txt;

	echo '
	<div class="', $verify_context['is_error'] ? 'error ' : '', 'smalltext">
		', $txt['question_areyouhuman'], '
		<input type="checkbox" name="are_you_human" value="1" ', !empty($verify_context['value']) ? 'checked="checked" ' : '', 'tabindex="', $context['tabindex']++, ' class="input_check">
	</div>';
}