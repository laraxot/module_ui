<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Sms;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\LU\Services\ProfileService;
use Modules\Notify\Models\Contact;
use Modules\Notify\Notifications\SmsNotification;

/**
 * Class Arr // Array is reserved.
 */
class Verified extends Component {
    public array $form_data = [];
    public bool $is_sent = false;
    public array $attrs = [];
    public string $tpl = '';
    public string $user_id = '';
    public Collection $my_validated_sms_addresses;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $tpl = 'v1', array $attrs) {
        // non sapevo in che altro modo passarlo
        $this->user_id = (string) Auth::id();
        $this->form_data = session()->get('form_data') ?? [];
        $this->tpl = $tpl;
        $this->mySmsAddresses();
    }

    public function mySmsAddresses() {
        $this->my_validated_sms_addresses = Contact::where('user_id', $this->user_id)->where('contact_type', 'mobile')->where('verified_at', '!=', null)->get();
        // Debugbar::info($this->my_validated_email_addresses);
    }

    public function updateFormData() {
        $this->emit('updateFormData', $this->form_data);
    }

    public function verify_sms() {
        $this->form_data['confirm_token'] = Str::random(6);

        $row = new Contact();
        $row->token = $this->form_data['confirm_token'];
        $row->model_type = 'profile';
        $row->model_id = ProfileService::make()->getProfile()->id;
        $row->user_id = $this->user_id;
        $row->contact_type = 'mobile';
        $row->value = $this->form_data['add_mobile'];
        $row->save();

        $n = new SmsNotification('', 'Verify Sms', 'Verification Code: '.$row->token);
        Notification::route('sms', '+393911352526')->notify($n);

        $this->is_sent = true;
    }

    public function verify_code() {
        $is_valid_contact = Contact::where('user_id', $this->user_id)->where('contact_type', 'mobile')->where('verified_at', null)->where('value', $this->form_data['add_mobile'])->where('token', $this->form_data['token'] ?? '');
        if (false == $is_valid_contact->get()->isEmpty()) {
            $row = $is_valid_contact->first();
            $row->verified_at = now();
            $row->save();
            session()->flash('message', 'Sms Verified');
            $this->is_sent = false;
        } else {
            session()->flash('status_error', 'Sms NOT Verified');
        }
        $this->mySmsAddresses();
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}