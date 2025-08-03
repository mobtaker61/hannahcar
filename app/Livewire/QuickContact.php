<?php

namespace App\Livewire;

use Livewire\Component;

class QuickContact extends Component
{
    public $name = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required|min:10',
        'message' => 'required|min:10'
    ];

    public function submit()
    {
        $this->validate();

        // Here you would typically save to database or send email
        session()->flash('message', app()->getLocale() === 'fa' ? 'پیام شما با موفقیت ارسال شد. در اسرع وقت با شما تماس خواهیم گرفت.' : 'Your message has been sent successfully. We will contact you soon.');

        $this->reset(['name', 'phone', 'message']);
    }

    public function render()
    {
        return view('livewire.quick-contact');
    }
}
