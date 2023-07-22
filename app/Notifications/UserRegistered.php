<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

class UserRegistered extends Notification
{
    use Queueable;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->to(env('SLACK_BOT_USER_DEFAULT_CHANNEL'))
            ->text('New user just registered!')
            ->headerBlock('User registered')
            ->contextBlock(function (ContextBlock $block) {
                $block->text(sprintf('User #%d', $this->user->id));
            })
            ->sectionBlock(function (SectionBlock $block) {
                $block->text('A new user just registered.');
                $block->field(sprintf("*ID #:*\n%d", $this->user->id))->markdown();
                $block->field(sprintf("*Name #:*\n%s", $this->user->fullName))->markdown();
                $block->field(sprintf("*Email #:*\n%s", $this->user->email))->markdown();
            })
            ->dividerBlock()
            ->sectionBlock(function (SectionBlock $block) {
                $block->text('Fuck yeah!');
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
