<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteConfirm extends Component
{
    public $btnTxt;
    public $id;

    /**
     * Create a new component instance.
     *
     * @param $btnTxt
     * @param $id
     */
    public function __construct($btnTxt, $id = 'delete-modal')
    {
        $this->btnTxt = $btnTxt;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-confirm');
    }
}
