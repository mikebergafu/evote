<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Notifications extends Component
{
    public $alertPhone = '';
    public $alertEnabled = false;
    public $blockSelfRegistration = false;

    public function mount()
    {
        $this->alertPhone = Setting::get('voter_alert_phone', '');
        $this->alertEnabled = Setting::get('voter_alert_enabled', false);
        $this->blockSelfRegistration = Setting::get('block_self_registration', false);
    }

    public function save()
    {
        $this->validate([
            'alertPhone' => 'nullable|string|max:20',
        ]);

        Setting::set('voter_alert_phone', $this->alertPhone);
        Setting::set('voter_alert_enabled', $this->alertEnabled);
        Setting::set('block_self_registration', $this->blockSelfRegistration);

        session()->flash('message', 'Settings saved!');
    }

    public function render()
    {
        return view('livewire.settings.notifications');
    }
}
