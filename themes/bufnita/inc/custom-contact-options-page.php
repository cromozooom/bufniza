<?php

return;
function theme_settings_page()
{
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function add_theme_menu_item()
{
    add_menu_page("Contact Info", "Contact Info", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");


function display_address_element()
{
    ?>
    <?php wp_editor(get_option('contact_address'), 'contact_address', array(
    'textarea_name' => 'contact_address',
    'media_buttons' => false,
    'textarea_rows' => 10
)); ?>
    <?php
}

function display_phones_element()
{
    ?>
    <input style="width: 450px;" type="text" name="contact_phones" id="contact_phones"
           value="<?php echo get_option('contact_phones'); ?>"/>
    <?php
}

function display_google_address_element()
{
    ?>
    <input style="width: 450px;" type="text" name="google_address" id="google_address"
           value="<?php echo get_option('google_address'); ?>"/>
    <?php
}

function display_theme_panel_fields()
{
    add_settings_section("section", "All Settings", null, "theme-options");

    add_settings_field("contact_address", "Address", "display_address_element", "theme-options", "section");
    add_settings_field("contact_phones", "Phones", "display_phones_element", "theme-options", "section");
    add_settings_field("google_address", "Google Maps address", "display_google_address_element", "theme-options", "section");

    register_setting("section", "contact_address");
    register_setting("section", "contact_phones");
    register_setting("section", "google_address");
}

add_action("admin_init", "display_theme_panel_fields");
