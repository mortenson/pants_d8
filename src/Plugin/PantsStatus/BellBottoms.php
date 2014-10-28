<?php

/**
 * Not sure how to best implement a Plugin as simple as the ctools one in D7.
 * This is the contents of the old ctools plugin:
<?php
$plugin = array(
'label' => t('Bellbottoms'),
'view_enabled callback' => 'pants_type_bellbottoms_view_enabled',
'view_disabled callback' => 'pants_type_bellbottoms_view_disabled',
);

function pants_type_bellbottoms_view_enabled() {
return array(
'#theme' => 'image',
'#path' => 'http://ecx.images-amazon.com/images/I/41xXmNdZn8L._SY200_.jpg',
);
}

function pants_type_bellbottoms_view_disabled() {
return array(
'#markup' => t('Off'),
);
}
?>
 * Should the image path be an annotation? How should "view_enabled callback" be converted?
 * Should this be a custom Plugin type?
 */
