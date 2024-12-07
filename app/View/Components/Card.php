<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $description;
    public $phone;
    public $province;
    public $canton;
    public $address;

    public function __construct($title, $description, $phone, $province, $canton, $address)
    {
        $this->title = $title;
        $this->description = $description;
        $this->phone = $phone;
        $this->province = $province;
        $this->canton = $canton;
        $this->address = $address;
    }

    public function render()
    {
        return view('components.card');
    }
}

