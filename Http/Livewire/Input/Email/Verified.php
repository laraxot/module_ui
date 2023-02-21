<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Email;

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
use Modules\Notify\Notifications\HtmlNotification;

/**
 * Class Arr // Array is reserved.
 */
class Verified extends Component {
    public array $form_data = [];
    public bool $is_sent = false;
    public array $attrs = [];
    public string $tpl = '';
    public string $user_id = '';
    public Collection $my_validated_email_addresses;

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
        $this->myEmailAddresses();
    }

    public function myEmailAddresses() {
        $this->my_validated_email_addresses = Contact::where('user_id', $this->user_id)->where('verified_at', '!=', null)->get();
        // Debugbar::info($this->my_validated_email_addresses);
    }

    public function updateFormData() {
        $this->emit('updateFormData', $this->form_data);
    }

    public function verify_email() {
        $this->form_data['confirm_token'] = Str::random(6);

        $row = new Contact();
        $row->token = $this->form_data['confirm_token'];
        $row->model_type = 'profile';
        $row->model_id = ProfileService::make()->getProfile()->id;
        $row->user_id = $this->user_id;
        $row->contact_type = 'email';
        $row->value = $this->form_data['add_email'];
        $row->save();

        Notification::route('mail', $row->value)
            ->notify(new HtmlNotification(config('mail.from.address'), 'Verify Email Address', '<h1>Verification Code</h1><h3>'.$row->token.'</h3>'));

        $this->is_sent = true;
    }

    public function verify_code() {
        $is_valid_contact = Contact::where('user_id', $this->user_id)->where('verified_at', null)->where('value', $this->form_data['add_email'])->where('token', $this->form_data['token'] ?? '');
        if (false == $is_valid_contact->get()->isEmpty()) {
            $row = $is_valid_contact->first();
            $row->verified_at = now();
            $row->save();
            session()->flash('message', 'Email Verified');
            $this->is_sent = false;
        } else {
            session()->flash('status_error', 'Email NOT Verified');
        }
        $this->myEmailAddresses();
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
