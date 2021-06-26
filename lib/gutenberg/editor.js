/**
* Gutenberg Styles.
*
* @package Raw Child
* @author  rawsta
* @license GPL-2.0-or-later
* @link    https://github.com/rawsta/raw-child/
*/

wp.domReady( () => {
    // Standard Buttonstyling entfernen.
    wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
    wp.blocks.unregisterBlockStyle('core/button', 'squared');

    // Neue Button Styles.
    wp.blocks.registerBlockStyle('core/button', {
        name: 'standard',
        label: wp.i18n.__('Standard', 'raw-child' ),
        isDefault: true,
    });

    wp.blocks.registerBlockStyle('core/button', {
        name: 'broad',
        label: wp.i18n.__('Broad', 'raw-child' ),
    });

    wp.blocks.registerBlockStyle('core/button', {
        name: 'huge',
        label: wp.i18n.__('Huge', 'raw-child' ),
    });

    /* Headlines */
    wp.blocks.registerBlockStyle('core/heading', {
        name: 'default',
        label: wp.i18n.__('Default', 'raw-child' ),
        isDefault: true,
    });

    wp.blocks.registerBlockStyle('core/heading', {
        name: 'large-white',
        label: wp.i18n.__('Large White', 'raw-child' ),
    });

    wp.blocks.registerBlockStyle('core/heading', {
        name: 'white-on-black-title',
        label: wp.i18n.__('White on Black Title', 'raw-child' ),
    });

    /* Paragraphs */

    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'notice-question',
        label: wp.i18n.__('Notice: Question', 'raw-child' )
    });

    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'notice-success',
        label: wp.i18n.__('Notice: Success', 'raw-child' )
    });

    wp.blocks.registerBlockStyle('core/paragraph', {
        name: 'notice-warning',
        label: wp.i18n.__('Notice: Warning', 'raw-child' )
    });


    /* Image Styles */
    wp.blocks.registerBlockStyle('core/image', {
        name: 'standard',
        label: wp.i18n.__('Standard', 'raw-child' ),
        isDefault: true,
    });

    wp.blocks.registerBlockStyle('core/image', {
        name: 'shadow',
        label: wp.i18n.__('Shadow', 'raw-child' ),
    });

    wp.blocks.registerBlockStyle('core/image', {
        name: 'filter-sepia',
        label: wp.i18n.__('Sepia Filter', 'raw-child' ),
    });

    wp.blocks.registerBlockStyle('core/image', {
        name: 'filter-grey',
        label: wp.i18n.__('Black/White Filter', 'raw-child' ),
    });

    /* Blockquotes */
    wp.blocks.registerBlockStyle('core/quote', {
        name: 'large',
        label: wp.i18n.__('Large', 'raw-child' ),
    });

    // blocks with inner blocks cause problems for now!
    /*wp.blocks.registerBlockStyle('core/media-text', {
        name: 'bottom-contact',
        label: 'Contact',
    });*/


});
