<?php

namespace IBX\Widget;

class WidgetArea {
    private $name;
    private $id;
    private $config = [
        'before_widget' => '<div class="col-4">',
        'after_widget'  => '</div>'
    ];

    public function __construct($n, $i)
    {
        $this->name = $n;
        $this->id = $i;

        register_sidebar([
            'name'          => $n,
            'id'            => $i
        ] + $this->config);
    }

    public static function getContent($c)
    {
        $append = [];

        ob_start();
            dynamic_sidebar($this->id);
            $content = ob_get_contents();
        ob_end_clean();

        $append[] = "<section class='widget-area' id='{$this->id}'>";
        $append[] = "<div class='container'>";
        $append[] = "<div class='row'>{$content}</div>";
        $append[] = "</div>";
        $append[] = "</section>";

        return $c .= implode(PHP_EOL, $append);
    }

    public function render()
    {
        add_filter('theme_custom_content', array($this, 'getContent'));
    }
}
