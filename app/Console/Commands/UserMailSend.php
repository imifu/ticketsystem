<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Models\Mail;
use App\Models\UserMail;

use App\Mail\UserMailSend;


class UserMailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:user_mail_send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'メルマガ送信処理';

    /**
     * Execute the console command.
     *
     * @return int
     */

     // 現在の時刻より過去のもので未送信フラグのものを取得し150件ずつ送信する
    public function handle()
    {

        Log::info("メルマガ送信処理開始！");

        $send_to_num = 150;
        $now = date("Y-m-d H:i:s");

        // 現在時刻と比較して送信時間が過去のメールデータを取得
        $mail = Mail::where('mails.send_flg', "=", '0')

        ->whereRaw('mails.send_time <= NOW()')

        ->where('mails.del_flg', "=", '0')
        ->first();

        if(!empty($mail)) {

            
            // 送信先を取得
            $sends = UserMail::where('user_mails.mail_id', "=", $mail->id)

            ->join('users', 'users.id', '=', 'user_mails.user_id')

            ->where('user_mails.send_flg', "=", '0')

            ->where('user_mails.del_flg', "=", '0')
            ->where('users.del_flg', "=", '0')

            ->select('*', 'user_mails.id as user_mail_id')
            ->get();

            // 送信先が居ないので送信済みに変更
            if(empty($sends)) {

                $mail->send_flg = 1;
                $mail->save();

            }

            // 見つかった送信先にメールを送信
            foreach($sends as $key => $send) {

                // 規定送信数（150通）を上回ったら送信を中断
                if($key > $send_to_num) {
                    break;
                }

                // メールアドレスが存在する場合のみ送信
                if(!empty($send->email)) {

                    // メール送信に使用する変数とメール送信処理そのもの
                    $params = $mail;
                    $params["email"] = $send->email;
                    $params["user_name"] = $send->last_name." ".$send->first_name;
                    $params["title"] = $mail->title;
                    $params["message"] = $mail->message;

                    // メール送信処理
                    Mail::send(new UserMailSend($params));

                    // 送信済みに変更
                    $send->send_flg = 1;
                    $send->save();

                }

            }

        }

        Log::info("メルマガ送信処理 無事終了！================================");

        return null;
    }
}
