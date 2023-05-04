<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Email;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\LU\Services\ProfileService;
use Modules\Notify\Models\Contact;
use Modules\Notify\Notifications\HtmlNotification;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

/**
 * Class Arr // Array is reserved.
 */
class Verified extends Component
{
    use InteractsWithConfirmationModal;

    public array $form_data = [];
    public int $step = 2;
<<<<<<< HEAD
    public string $tpl = '';
=======
    public string $tpl;
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af
    public string $user_id = '';
    public Collection $my_validated_email_addresses;
    public array $attrs = [];

    /**
     * Undocumented function.
     *
     * @return void
     */
<<<<<<< HEAD
    public function mount(string $tpl = 'v1')
    {
        // non sapevo in che altro modo passarlo
        $this->user_id = (string) Auth::id();
        $form_data = session()->get('form_data');
        if (! is_array($form_data)) {
            $form_data = [];
        }
        $this->form_data = $form_data;
=======
    public function mount(string $tpl = 'v1', ?array $attrs = [])
    {
        // non sapevo in che altro modo passarlo
        $this->user_id = (string) Auth::id();
        $this->form_data = (array) session()->get('form_data');
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af
        $this->tpl = $tpl;
        $this->myEmailAddresses();
    }

    public static function getName(): string
    {
        return 'input.email.verified';
    }

    public function myEmailAddresses(): void
    {
        $this->my_validated_email_addresses = Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', '!=', null)->get();
        // Debugbar::info($this->my_validated_email_addresses);
    }

    public function updateFormData(): void
    {
        $this->emit('updateFormData', $this->form_data);
    }

    public function verify_email(): void
    {
<<<<<<< HEAD
        $this->form_data['confirm_token'] = strval(rand(10000, 99999));
=======
        $this->form_data['confirm_token'] = rand(10000, 99999);
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af

        if (Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', '!=', null)->firstWhere('value', $this->form_data['add_email'])) {
            $this->askForConfirmation(
                callback: function () {
                },
                prompt: [
                    'title' => __('Attenzione!'),
                    'message' => __('Non puoi aggiungere un indirizzo email già esistente'),
                    'confirm' => __('Ok'),
                    'cancel' => __('Annulla'),
                ],
            );

            return;
        }

        $row = new Contact();
        $row->token = strval($this->form_data['confirm_token']);
        $row->model_type = 'profile';
        $row->model_id = strval(ProfileService::make()->getProfile()->id);
        $row->user_id = $this->user_id;
        $row->contact_type = 'email';
        $row->value = $this->form_data['add_email'];
        $row->save();
        $mail = strval(config('mail.from.address'));

<<<<<<< HEAD
        Notification::route('mail', $row->value)->notify(new HtmlNotification(strval(config('mail.from.address')), 'Verify Email Address', '<h1>Verification Code</h1><h3>'.$row->token.'</h3>'));
=======
        Notification::route('mail', $row->value)->notify(new HtmlNotification($mail, 'Verify Email Address', '<h1>Verification Code</h1><h3>'.$row->token.'</h3>'));
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af

        $this->step = 3;
    }

<<<<<<< HEAD
    /**
     * Undocumented function.
     *
     * @return void
     */
    public function verify_code()
=======
    public function verify_code(): void
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af
    {
        $is_valid_contact = Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', null)->where('value', $this->form_data['add_email'])->where('token', $this->form_data['token'] ?? '')->get();
        if (false == $is_valid_contact->isEmpty()) {
            $row = $is_valid_contact->first();
            if (null == $row) {
<<<<<<< HEAD
                throw new \Exception('['.__LINE__.']['.__FILE__.']');
=======
                throw new \Exception('[][]');
>>>>>>> eb9ac63612a2a9a65cf3585dad0a6f569a9685af
            }
            $row->verified_at = now();
            $row->save();

            $this->form_data['email'] = $this->form_data['add_email'];

            $this->updateFormData();

            session()->flash('message', 'Email Verified');

            $this->step = 2;
        } else {
            session()->flash('status_error', 'Email NOT Verified');
        }
        $this->myEmailAddresses();
    }

    public function add(): void
    {
        $this->step = 2;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
