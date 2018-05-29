<?php

namespace IBX\Widget;

use App;

class CustomWidget extends \WP_Widget {
    public $id;
    public $name;
    public $args;
    public $view;
    public $form;
    public $fields = array();

    public function __construct($i, $n, $a = [])
    {
        $this->id = $i;
        $this->name = $n;
        $this->args = $a;
        $this->view = $i;
        $this->form = $i;

        parent::__construct(
            $this->id,
            $this->name,
            $this->args
		);
    }

    public static function create($i, $n, $a = [])
    {
        return new self($i, $n, $a);
    }

    public function setView($s)
    {
        $this->view = $s;
        return $this;
    }

    public function setForm($s)
    {
        $this->form = $s;
        return $this;
    }

    public function widget($a, $i)
    {
        echo App\sage('blade')->render('widgets.display.'.$this->view, $i);
    }

    public function form($i)
    {
        $i['form'] = $this;
        echo App\sage('blade')->render('widgets.form.'.$this->form, $i);
    }

    public function acceptFields()
    {
        $this->fields = func_get_args();
        return $this;
    }

    public function update($n, $o)
    {
        $instance = array();
        foreach($this->fields as $f) {
            $instance[$f] = ( ! empty( $n[$f] ) ) ? sanitize_text_field( $n[$f] ) : '';
        }
        return $instance;
    }

    public function register()
    {
        return register_widget($this);
    }
}
