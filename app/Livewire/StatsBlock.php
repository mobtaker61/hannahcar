<?php

namespace App\Livewire;

use Livewire\Component;

class StatsBlock extends Component
{
    public $stats = [];
    public $benefits = [];

    public function mount()
    {
        $this->stats = [
            [
                'number' => '250+',
                'label' => app()->getLocale() === 'fa' ? 'خودرو فعال' : 'Active Vehicles',
                'icon' => 'fas fa-car'
            ],
            [
                'number' => '1,500+',
                'label' => app()->getLocale() === 'fa' ? 'مشتری راضی' : 'Happy Customers',
                'icon' => 'fas fa-users'
            ],
            [
                'number' => '10+',
                'label' => app()->getLocale() === 'fa' ? 'سال تجربه' : 'Years Experience',
                'icon' => 'fas fa-calendar-alt'
            ],
            [
                'number' => '24/7',
                'label' => app()->getLocale() === 'fa' ? 'پشتیبانی' : 'Support',
                'icon' => 'fas fa-headset'
            ]
        ];

        $this->benefits = [
            [
                'title' => app()->getLocale() === 'fa' ? 'ضمانت کیفیت' : 'Quality Guarantee',
                'description' => app()->getLocale() === 'fa' ? 'تمام خودروها با ضمانت کامل کیفیت ارائه می‌شوند' : 'All vehicles are provided with full quality guarantee',
                'icon' => 'fas fa-shield-alt'
            ],
            [
                'title' => app()->getLocale() === 'fa' ? 'تحویل سریع' : 'Fast Delivery',
                'description' => app()->getLocale() === 'fa' ? 'تحویل خودرو در کمترین زمان ممکن' : 'Vehicle delivery in the shortest possible time',
                'icon' => 'fas fa-clock'
            ],
            [
                'title' => app()->getLocale() === 'fa' ? 'پشتیبانی 24/7' : '24/7 Support',
                'description' => app()->getLocale() === 'fa' ? 'پشتیبانی شبانه‌روزی برای تمام مشتریان' : '24/7 support for all customers',
                'icon' => 'fas fa-headset'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.stats-block');
    }
}
