<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Email;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\ExtraField\Actions\ExtraFieldGroup\Create;
use Modules\ExtraField\Models\ExtraFieldGroup;
use Modules\ExtraField\Models\ExtraFieldGroupMorph;
use Modules\LU\Services\ProfileService;
use Modules\Notify\Models\Contact;
use Modules\Notify\Notifications\HtmlNotification;
use Modules\Xot\Datas\XotData;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

/**
 * Class Arr // Array is reserved.
 */
class Verified extends Component
{
    use InteractsWithConfirmationModal;

    public array $form_data = [];
    public int $step = 1;
    public string $tpl;
    public string $user_id = '';
    public Collection $validated_email_addresses;
    public Collection $not_validated_email_addresses;
    public array $attrs = [];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $tpl = 'v1')
    {
        // non sapevo in che altro modo passarlo
        $this->user_id = (string) Auth::id();
        $form_data = session()->get('form_data');
        if (! is_array($form_data)) {
            $form_data = [];
        }
        $this->form_data = $form_data;
        $this->tpl = $tpl;
        $this->myEmailAddresses();
    }

    public static function getName(): string
    {
        return 'input.email.verified';
    }

    public function myEmailAddresses(): void
    {
        $this->validated_email_addresses = Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', '!=', null)->get();
        $this->not_validated_email_addresses = Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', null)->get();
    }

    public function updateFormData(): void
    {
        $this->emit('updateFormData', $this->form_data);
    }

    public function addEmail(): void
    {
        $this->form_data['confirm_token'] = strval(rand(10000, 99999));

        $xot = XotData::make();
        $profile = $xot->getProfileModelByUserId($this->user_id);

        $extra_field_group_id = (string) ExtraFieldGroup::firstWhere('name', 'email')?->id;
        app(Create::class)->execute($profile, $extra_field_group_id, $this->user_id, ['uuid' => Str::uuid()->toString(), 'token' => $this->form_data['confirm_token'], 'email' => $this->form_data['add_email']]);

        // da mettere in extrafieldgroupmorph e extrafieldmorph
        /*$row = new Contact();
        $row->token = strval($this->form_data['confirm_token']);
        $row->model_type = 'profile';
        $row->model_id = strval(ProfileService::make()->getProfile()->id);
        $row->user_id = $this->user_id;
        $row->contact_type = 'email';
        $row->value = $this->form_data['add_email'];
        $row->save();
        $mail = strval(config('mail.from.address'));

        Notification::route('mail', $row->value)->notify(new HtmlNotification(strval(config('mail.from.address')), 'Verify Email Address', '<h1>Verification Code</h1><h3>'.$row->token.'</h3>'));
        Notification::route('mail', $row->value)->notify(new HtmlNotification($mail, 'Verify Email Address', '<h1>Verification Code</h1><h3>'.$row->token.'</h3>'));
       */

        $this->sendToken();
    }

    public function sendToken(): void
    {
        // è sbagliato. bisogna usare Datas
        $mail = strval(config('mail.from.address'));
        Notification::route('mail', $this->form_data['add_email'])->notify(new HtmlNotification($mail, 'Verify Email Address', '<h1>Verification Code</h1><h3>'.strval($this->form_data['confirm_token']).'</h3>'));
    }

    public function verifyOldEmail(): void
    {
        $this->addEmail();

        $this->step = 3;
    }

    /**
     * Undocumented function.
     */
    public function verifyEmail(): void
    {
        /*
        fare spatie action extraFieldGroupMorph

        if (ExtraFieldGroupMorph::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', '!=', null)->firstWhere('value', $this->form_data['add_email'])) {
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
         }*/

        $this->addEmail();

        $this->step = 3;
    }

    public function verifyCode(): void
    {
        /*
        fare spatie action extraFieldGroupMorph

        $is_valid_contact = Contact::where('user_id', $this->user_id)->where('contact_type', 'email')->where('verified_at', null)->where('value', $this->form_data['add_email'])->where('token', $this->form_data['token'] ?? '')->get();
        if (false == $is_valid_contact->isEmpty()) {
            $row = $is_valid_contact->first();
            if (null == $row) {
                throw new \Exception('['.__LINE__.']['.__FILE__.']');
            }
            $row->verified_at = now();
            $row->save();

            $this->form_data['email'] = $this->form_data['add_email'];

            $this->updateFormData();

            session()->flash('message', 'Email Verified');

            $this->step = 2;
        } else {
            session()->flash('status_error', 'Email NOT Verified');
        }*/
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
