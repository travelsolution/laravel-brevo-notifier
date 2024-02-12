<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use TravelSolution\LaravelBrevoNotifier\BrevoService;
use TravelSolution\LaravelBrevoNotifier\BrevoSmsChannel;
use TravelSolution\LaravelBrevoNotifier\BrevoSmsMessage;
use TravelSolution\LaravelBrevoNotifier\Tests\User;

it('send notification via BrevoChannel should call BrevoService sendSms method', function () {
    $mock = $this->mock(BrevoService::class)->shouldReceive('sendSms')->once();
    $channel = new BrevoSmsChannel($mock->getMock());
    $channel->send(new User(), new class extends Notification {
        public function via()
        {
            return [BrevoSmsChannel::class];
        }

        public function toBrevoSms(Model $notifiable): BrevoSmsMessage
        {
            return new BrevoSmsMessage();
        }
    });
});
