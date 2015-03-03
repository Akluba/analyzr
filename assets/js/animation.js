var activeSection = $('.container').attr('id');

switch(activeSection){
	case 'settings_active_container':
		$('#setting_icon').addClass('current_section');
		break;
	case 'builder_active_container':
		$('#builder_icon').addClass('current_section');
		break;
	case 'send_active_container':
		$('#send_icon').addClass('current_section');
		break;
	default:
		$('#analyze_icon').addClass('current_section');
		break;
}