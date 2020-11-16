<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use App\Models\UserStatus;
use App\Models\UserPacket;
use App\Models\Packet;

class UserPacketSetPaid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userpacket:setpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user_packet = UserPacket::where('is_active', 1)->update(['is_paid' => 1]);
    }
}
