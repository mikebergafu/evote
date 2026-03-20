<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Notifications extends Component
{
    public $alertPhone = '';
    public $alertEnabled = false;

    public function mount()
    {
        $this->alertPhone = Setting::get('voter_alert_phone', '');
        $this->alertEnabled = Setting::get('voter_alert_enabled', false);
    }

    public function save()
    {
        $this->validate([
            'alertPhone' => 'nullable|string|max:20',
        ]);

        Setting::set('voter_alert_phone', $this->alertPhone);
        Setting::set('voter_alert_enabled', $this->alertEnabled);

        session()->flash('message', 'Notification settings saved!');
    }

    public function render()
    {
        return view('livewire.settings.notifications');
    }
}
