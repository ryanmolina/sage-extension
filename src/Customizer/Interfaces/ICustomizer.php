<?php

namespace IBX\Customizer\Interfaces;

interface ICustomizer {
    public static function register( $wp_customize );
    public static function header_output();
    public static function live_preview();
}
