<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    public $session;

    /**
      * Create a new component instance.
      *
      * @param $type
      * @param $message
      * @param $session
      */
    public function __construct($type, $message = null, $session = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->session = $session;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (filled($this->session) && !session()->has($this->session)) {
            return '';
        }
        return view('components.alert');
    }
}
