<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackToPageButton extends Component
{
    public $route;
    public $title = "torna alla schermata precedente";

    public function __construct($route)
    {
        $this->route = $route;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.back-to-page-button', [
            'route' => $this->route,
            'title' => $this->title
        ]);
    }
}
