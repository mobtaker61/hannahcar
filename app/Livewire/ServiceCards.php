<?php

namespace App\Livewire;

use App\Models\InquiryForm;
use Livewire\Component;

class ServiceCards extends Component
{
    public $services = [];

    public function mount(): void
    {
        $forms = InquiryForm::query()
            ->active()
            ->ordered()
            ->take(4)
            ->get();

        $this->services = $forms->map(function (InquiryForm $form) {
            return [
                'id' => $form->id,
                'title' => $form->title,
                'description' => $form->description,
                'icon' => $form->icon ? 'fas fa-'.str_replace('_', '-', $form->icon) : 'fas fa-file-alt',
                'featured_image' => null,
                'link' => route('inquiry-forms.show', $form->slug),
                'color' => $form->color,
            ];
        })->toArray();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.inquiry-cards');
    }
}
