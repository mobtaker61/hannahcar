<?php

namespace App\Livewire;

use Livewire\Component;

class SiteFooter extends Component
{
    public $email = '';

    public function subscribeNewsletter()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        // Here you would typically save to database
        session()->flash('newsletter_message', 'عضویت شما در خبرنامه با موفقیت انجام شد.');

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.site-footer');
    }
}
