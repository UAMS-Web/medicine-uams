<?php

add_action('acf/input/admin_head', 'my_acf_admin_head');

/**
 * Print the script and style that move the post editor into an ACF field.
 *
 * Runs on acf/input/admin_head, wherever ACF prints its input scripts. The
 * script moves the editor into the field keyed field_573f70ac9357c, whose
 * wrapper ACF gives the class acf-field-573f70ac9357c; on a screen without
 * that field it finds nothing to move.
 */
function my_acf_admin_head(): void
{

    ?>
    <script type="text/javascript">
    (function($) {

        $(document).ready(function(){

            $('.acf-field-573f70ac9357c .acf-input').append( $('#postdivrich') );

        });

    })(jQuery);
    </script>
    <style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: transparent;
            padding-top: 0;
        }
    </style>
    <?php

}
