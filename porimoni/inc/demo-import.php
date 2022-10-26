<?php
function ocdi_import_files() {
	return [
		[
			'import_file_name'             => 'Porimoni Demo Import',
			'categories'                   => [ 'Portfolio' ],
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-content/porimoni-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-content/porimoni-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-content/porimoni-customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'inc/demo-content/preview.png',
			'preview_url'                  => 'https://belaltheme.com/Mp/Porimoni/Porimoni/',
			'import_notice'                => esc_html__( 'Install and active all required plugins before you click on the "Yes! Important" button.', 'porimoni' ),
		]
	];
}

add_filter( 'ocdi/import_files', 'ocdi_import_files' );