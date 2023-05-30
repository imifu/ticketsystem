<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use Stripe\StripeClient;

use App\Models\Admin;
use App\Models\User;
use App\Models\News;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\Models\UserTicket;
use App\Models\PaymentData;
use App\Models\PaymentLog;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserBuyTicketRequest;


use App\Mail\UserRegistMail;
use App\Mail\UserBuyTicketMail;

class UsersController extends Controller
{
    //ログインページ表示
    public function login() {
        return view('users.login');
    }


    // 会員登録ページ
    public function regist() {
        return view('users.regist');
    }

    // 会員登録確認ページ
    public function registConf(UserRequest $request) {
        $data = $request->all();


        // 会員に同一メールアドレスが居ないか確認
        $user = User::where('email', $data["email"])
        ->where('del_flg', "0")->first();

        // 同一メールアドレスがある場合はエラー
        if(!empty($user->id)) {
            return view('users.regist', ['error' => 'このメールアドレスは既に登録されています。']);
        }

        return view('users.regist_conf', compact('data'));
    }

    // ユーザーデータの保存
    public function userSave(UserRequest $req) {

        User::updateOrCreate(
            ['id' => $req->id],
            [
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'sex' => $req->sex,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'tel' => $req->tel,
                'post_code' => $req->post_code,
                'pref' => $req->pref,
                'address' => $req->address,
                'memo' => $req->memo,
            ]
        );

        // 会員登録完了のメール送信
        $params = $req->all();
        Mail::send(new UserRegistMail($params));

        return redirect(route("users.thanks"));
    }

    // 会員登録完了ページ
    public function thanks() {
        return view('users.thanks');
    }


    // マイページトップ
    public function index() {
        $user = Auth::user();

        return view('users.index', compact('user'));
    }


    // チケット購入履歴
    public function history() {


        $user = Auth::user();

        $datas = UserTicket::where('user_tickets.user_id', $user->id)
        ->join('tickets', 'tickets.id', '=', 'user_tickets.ticket_id')
        ->join('ticket_details', 'ticket_details.id', '=', 'user_tickets.ticket_detail_id')

        ->select('*', 'user_tickets.id as user_ticket_id')

        ->where('user_tickets.del_flg', '=', '0')

        ->orderBy('user_tickets.created_at', 'DESC')
        ->get();

        return view('users.history', compact('datas'));
    }

    // 会員情報プロフィール設定
    public function profile() {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }


    // 会員情報プロフィール設定
    public function profileForm() {

        $user = Auth::user();

        return view('users.profile_form', compact('user'));

    }

    // 会員情報プロフィール確認
    public function profileConf(UserRequest $request) {
        $data = $request->all();
        return view('users.profile_conf', compact('data'));
    }

    // 会員情報プロフィールの保存
    public function profileComp(UserRequest $req) {

        $user = Auth::user();

        User::updateOrCreate(
            ['id' => $user->id],
            [
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'sex' => $req->sex,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'tel' => $req->tel,
                'post_code' => $req->post_code,
                'pref' => $req->pref,
                'address' => $req->address,
            ]
        );

        return redirect(route("users.profile"));
    }


    // チケットの購入
    public function buyTicket($id = null) {

        if(empty($id)) {
            return redirect(route("page.index"));
        }

        $user = Auth::user();

        $data = TicketDetail::where('tickets.del_flg', '=', '0')
        ->join('tickets', 'tickets.id', '=', 'ticket_details.ticket_id')
        ->where('ticket_details.id', '=', $id)
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')
        ->where('tickets.sold_out_flg', '=', '0')

        ->where('ticket_details.sold_out_flg', '=', '0')

        ->select('tickets.*', 'ticket_details.*', 'ticket_details.id as ticket_detail_id')

        ->first();


        return view('users.buy_ticket', compact('data'));
    }



    // チケット購入データの確認
    public function buyTicketConfirm(UserBuyTicketRequest $request) {

        $data = $request->all();

        if(empty($request->ticket_detail_id)) {
            return redirect(route("page.index"));
        }

        $ticket_data = TicketDetail::where('tickets.del_flg', '=', '0')
        ->join('tickets', 'tickets.id', '=', 'ticket_details.ticket_id')
        ->where('ticket_details.id', '=', $data["ticket_detail_id"])
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')
        ->where('tickets.sold_out_flg', '=', '0')

        ->where('ticket_details.sold_out_flg', '=', '0')

        ->select('tickets.*', 'ticket_details.*', 'ticket_details.id as ticket_detail_id')

        ->first();

        $intent = null;
        $stripe = null;

        // $stripe = new StripeClient(
        //     env('STRIPE_SECRET_KEY'),
        // );

        // if($data["payment_flg"] == config('payment_flg.CREDIT')) {

        //     $intent = $stripe->paymentIntents->create(
        //         [
        //             'amount' => $ticket_data->amount,
        //             'currency' => 'jpy',
        //             'description' => $ticket_data->title,
        //             'payment_method_types' => ['card']
        //         ]
        //     );


        // }

        if(empty($ticket_data)) {
            return view('users.no_ticket', ['msg' => '該当のチケットは現在販売中ではありません。']);
        }

        // 一人あたりの購入制限枚数が存在する場合の処置
        if(!empty($ticket_data["limit_sale"])) {

            $user = Auth::user();

            $limit = $ticket_data["limit_sale"];

            $sold_tickets = UserTicket::where('ticket_detail_id', $ticket_data->ticket_detail_id)
            ->where('user_id', "=", $user->id)
            ->where('valid_flg', "=", 1)
            ->where('del_flg', "=", 0)
            ->get()->count();

            if($limit <= $sold_tickets) {
                return view('users.no_ticket', ['msg' => '該当のチケットは既に規定の販売枚数を購入している為購入ができません。']);
            }

            if($limit < $sold_tickets + $data["buy_num"]) {
                return view('users.no_ticket', ['msg' => '該当のチケットを'.$sold_tickets.'枚購入している為、'.$data["buy_num"].'枚購入することができません。一人あたり購入可能な枚数は'.$limit.'枚です']);
            }

        }





        // 在庫計算
        $stock = $ticket_data->ticket_amount;

        $sold_tickets = UserTicket::where('ticket_detail_id', $ticket_data->ticket_detail_id)
        ->where('valid_flg', "=", 1)
        ->where('del_flg', "=", 0)
        ->get()->count();


        // 売り切れの場合
        if($stock <= $sold_tickets) {

            // 売り切れフラグを立てる
            $ticket_detail = TicketDetail::find($ticket_data->ticket_detail_id);
            $ticket_detail->sold_out_flg = 1;
            $ticket_detail->update();

            return view('users.no_ticket', ['msg' => '該当のチケットは売り切れの為、新しくご購入頂くことができません。']);
        }


        // 複数購入による売り切れの場合
        if($stock < $sold_tickets + $data["buy_num"]) {
            return view('users.no_ticket', ['msg' => '該当のチケットは'.$data["buy_num"].'枚分の在庫がありません。']);
        }


        return view('users.buy_ticket_conf', compact('data', 'ticket_data','intent', 'stripe'));

    }


    // ユーザーのチケット購入処理
    public function buyTicketComp(Request $req) {

        $data = $req->all();

        // var_dump($data);
        // exit;

        if(empty($req->ticket_detail_id)) {
            return redirect(route("page.index"));
        }

        $ticket_data = TicketDetail::where('tickets.del_flg', '=', '0')
        ->join('tickets', 'tickets.id', '=', 'ticket_details.ticket_id')
        ->where('ticket_details.id', '=', $data["ticket_detail_id"])
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')

        // 売り切れた場合は購入できないようにする
        ->where('tickets.sold_out_flg', '=', '0')

        ->where('ticket_details.sold_out_flg', '=', '0')

        ->select('tickets.*', 'ticket_details.*', 'ticket_details.id as ticket_detail_id')

        ->first();

        if(empty($ticket_data)) {
            return view('users.no_ticket', ['msg' => '該当のチケットは現在販売中ではありません。']);
        }

        $user = Auth::user();

        $stripe = new StripeClient(
            env('STRIPE_SECRET_KEY'),
        );

        // $stripe->paymentIntents->create(
        //     [
        //         'amount' => $ticket_data->amount,
        //         'currency' => 'jpy',
        //         'description' => $ticket_data->title,
        //         'payment_method_types' => ['card']
        //     ]
        // );
        // json_encode(array('client_secret' => $intent->client_secret));

        // クレジットカード課金処理の開始

        try {

            // トランザクション開始
            DB::beginTransaction();

            // 在庫計算
            $stock = $ticket_data->ticket_amount;

            $sold_tickets = UserTicket::where('ticket_detail_id', $ticket_data->ticket_detail_id)
            ->where('valid_flg', "=", 1)
            ->where('del_flg', "=", 0)
            ->get()->count();

            // 売り切れの場合
            if($stock <= $sold_tickets) {

                // 売り切れフラグを立てる
                $ticket_detail = TicketDetail::find($ticket_data->ticket_detail_id);
                $ticket_detail->sold_out_flg = 1;
                $ticket_detail->update();

                // 適用された変更をデータベースに保存
                DB::commit();

                return view('users.no_ticket', ['msg' => '該当のチケットは売切のため、現在販売中ではありません。']);


            // この枚数は残っていない
            } else if($stock < $sold_tickets + $data["ticket_buy_num"]) {

                DB::rollBack();

                return view('users.no_ticket', ['msg' => '該当のチケットは'.$data["ticket_buy_num"].'枚分の在庫がありません。']);


            // この枚数を購入するとちょうど売切
            } else if($stock == $sold_tickets + $data["ticket_buy_num"]) {

                // 売り切れフラグを立てる
                $ticket_detail = TicketDetail::find($ticket_data->ticket_detail_id);
                $ticket_detail->sold_out_flg = 1;
                $ticket_detail->update();
            }


            $payment_result = $stripe->charges->create([
                'amount' => $ticket_data->amount * $data["ticket_buy_num"],
                'currency' => 'jpy',
                'source' => $data["stripeToken"],
                'description' => $ticket_data->title.'|サイト会員ID：'.$user->id."| 購入チケットID：".$data["ticket_detail_id"]."|email：".$user->email."|tel：".$user->tel,
            ]);

            if(!$payment_result["paid"] || empty($payment_result["id"])) {
                // DBロールバック
                DB::rollBack();
                return redirect(route("users.no_payment"));
            }


            // 購入完了
            // 購入した枚数分データをINSERTする


            for($i = 1; $i <= $data["ticket_buy_num"]; $i++) {

                $user_ticket = new UserTicket;
                $user_ticket->user_id = $user->id;
                $user_ticket->ticket_id = $ticket_data->ticket_id;
                $user_ticket->ticket_detail_id = $ticket_data->ticket_detail_id;


                // 単一の復号化パスを取得
                $ticket_hash = Hash::make($user->email.date("YmdHis").$i.$user->id.$ticket_data->ticket_id.$ticket_data->ticket_detail_id.$i);
                $ticket_hash = str_replace("/", "_", $ticket_hash);

                $user_ticket->qr_code = $ticket_hash;
                $user_ticket->amount = $user_ticket->ticket_id;
                $user_ticket->valid_flg = 1;
                $user_ticket->payment_flg = "1";
                $user_ticket->seat = "未定";
                $user_ticket->come_flg = 0;
                $user_ticket->save();

                $payment_log = new PaymentLog;
                $payment_log->user_id = $user->id;
                $payment_log->user_ticket_id = $user_ticket->id;
                $payment_log->stripe_id = $payment_result["id"];
                $payment_log->email = $user->email;
                $payment_log->amount = $user_ticket->ticket_id;
                $payment_log->payment_date = date("Y-m-d H:i:s");
                $payment_log->save();

                $payment_data = new PaymentData;
                $payment_data->user_ticket_id = $user_ticket->id;
                $payment_data->ticket_id = $ticket_data->ticket_id;
                $payment_data->ticket_detail_id = $ticket_data->ticket_detail_id;
                $payment_data->payment_log_id = $payment_log->id;
                $payment_data->amount = $user_ticket->ticket_id;
                $payment_data->payment_date = date("Y-m-d H:i:s");
                $payment_data->save();

            }

            // トランザクション開始してからここまでのDB操作を適用
            DB::commit();


            // 会員向け チケット購入完了のメール送信
            $params = $ticket_data;
            $params["name"] = $user->last_name." ".$user->first_name;
            $params["email"] = $user->email;
            $params["amount"] = $params["amount"] * $data["ticket_buy_num"];
            $params["ticket_buy_num"] = $data["ticket_buy_num"];

            Mail::send(new UserBuyTicketMail($params));

            return redirect(route("users.buyTicketThanks"));



        } catch (Exception $e) {

            // トランザクション開始してからここまでのDB操作を無かったことにする
            DB::rollBack();
            // Log::error($e);

            // 決済成功しててException発生のパターンがある場合ここに処理


            // 決済失敗を伝えるページにリダイレクト
            return redirect(route("users.no_payment"));
        }

    }

    // チケット購入完了
    public function buyTicketThanks() {
        return view('users.buy_ticket_complete');
    }


    // 決済失敗ページ
    public function noPayment() {
        return view('users.no_payment');
    }


}
