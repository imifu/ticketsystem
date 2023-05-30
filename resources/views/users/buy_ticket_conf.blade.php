@extends('layouts.page')

@section('contents')

<article>

    <h1 class="heading3 u-mb-16">購入内容確認</h1>
    <p class="u-fz-14 u-ta-c u-mb-40">※まだ購入は完了していません。</p>

    <div class="container">

        <form action="{{route('users.buyTicketComp')}}" method="POST">
            @csrf

            <input type="hidden" name="ticket_detail_id" value="{{ $ticket_data->ticket_detail_id }}">

            <div class="u-mb-56">
                <h2 class="heading1">ご購入されるチケット</h2>
                <div class="ticket__wrap">
                    <div class="ticket__inner">
                        <div class="ticket__item__img"><img src="{{ asset($ticket_data->image) }}" alt=""></div>
                        <div class="ticket__item__outline">
                            <p class="ticket__item__artist">{{ $ticket_data->owner_name }}</p>
                            <p class="ticket__item__eventTitle">{{ $ticket_data->live_name }}</p>
                            <dl class="ticket__dl">
                                <dt>チケット:</dt>
                                <dd>{{ $ticket_data->ticket_name }}　{{ number_format($ticket_data->amount) }}円</dd>
                            </dl>
                            <dl class="ticket__dl">
                                <dt>開催日時:</dt>
                                <dd>{{ date('Y/m/d', strtotime($ticket_data->open_date)) }}({{ config('week_name.'.date('w', strtotime($ticket_data->open_date))) }}){{ date('H:i', strtotime($ticket_data->open_date)) }}</dd>
                            </dl>
                            <dl class="ticket__dl">
                                <dt>開催場所:</dt>
                                <dd>{{ $ticket_data->place_name }}<br>
                                    {!! nl2br($ticket_data->place) !!}</dd>
                            </dl>
                            <dl class="ticket__dl">
                                <dt>詳　　細:</dt>
                                <dd>{!! nl2br($ticket_data->ticket_explain) !!}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>


            <div class="u-mb-56">
                <h2 class="heading1">手数料</h2>
                <p>{{ $ticket_data['commission'] }} 円　</p>
            </div>


            <div class="u-mb-56">
                <h2 class="heading1">購入枚数</h2>
                <p>{{ $data['buy_num'] }} 枚　<span class="link u-fw-b" onclick="history.back()">変更する</span></p>
            </div>

            <div class="u-mb-56">
                <h2 class="heading1">決済方法</h2>
                <p>{{ config('payment_flg.'.$data["payment_flg"]) }}　<!-- <span class="link u-fw-b" onclick="history.back()">変更する</span> --></p>
            </div>

            <div class="privacy__wrap">
                <p>@include('elements/regist_policy')</p>
            </div>

            <div class="privacy__check">

                <label>
                    <input type="checkbox" id="u_agree" name="privacy" value="1" required> 購入内容を確認し、<br class="u-sp">会員規約・<a href="{{ route('page.privacy'); }}" target="_blank">プライバシーポリシー</a>に<br class="u-sp">同意の上、購入する
                </label>
            </div>

            <div class="btn__wrap u-mt-0">
                <button id="go_payment" onclick="return false;" class="btn" type="submit" name="submit">決済へ進む</button>
            </div>

            <script>
                $("#go_payment").on("click", function() {

                    if ($("#u_agree").is(":checked") == false) {
                        alert("会員規約・プライバシーポリシーに同意してください。");
                        return false;
                    }

                    $("#stripe_buy_btn").find("button").click();
                });
            </script>
        </form>

        <form action="{{route('users.buyTicketComp')}}" method="POST" id="stripe_buy_btn" style="display:none;">
            @csrf
            <input type="hidden" name="ticket_detail_id" value="{{ $ticket_data->ticket_detail_id }}">
            <input type="hidden" name="ticket_amount" value="{{ $ticket_data->amount }}">
            <input type="hidden" name="ticket_buy_num" value="{{ $data['buy_num'] }}">

            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ env('STRIPE_PUBLIC_KEY') }}"
            data-amount="{{ ( $ticket_data->amount * $data['buy_num'] ) + $ticket_data['commission'] }}"
            data-name="{{ $ticket_data->ticket_name }}"
            data-email="{{ $auth_user->email }}"
            data-label="決済"
            data-description="{{ $ticket_data->title }}"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="ja"
            data-currency="JPY">

            </script>
    </div>

    </form>

    <?php

    // <script src="https://js.stripe.com/v3/"></script>

    // <form id="payment-form">
    //   <div id="payment-element">
    //     <!--Stripe.js injects the Payment Element-->
    //   </div>
    //   <button id="submit">
    //     <div class="spinner hidden" id="spinner"></div>
    //     <span id="button-text">Pay now</span>
    //   </button>
    //   <div id="payment-message" class="hidden"></div>
    // </form>



    // <script>

    // const stripe = Stripe("{{ env('STRIPE_PUBLIC_KEY') }}");

    // //

    // // The items the customer wants to buy
    // const items = [{ id: "xl-tshirt" }];

    // let elements;

    // initialize();
    // checkStatus();

    // document
    //   .querySelector("#payment-form")
    //   .addEventListener("submit", handleSubmit);

    // let emailAddress = '';
    // // Fetches a payment intent and captures the client secret
    // async function initialize() {
    //   const clientSecret = "{{ $intent->client_secret }}";

    //   const appearance = {
    //     theme: 'flat'
    //   };

    //   elements = stripe.elements({ clientSecret , appearance });

    //   const paymentElementOptions = {
    //     layout: "tabs",
    //   };

    //   const paymentElement = elements.create("payment", paymentElementOptions);
    //   paymentElement.mount("#payment-element");
    // }

    // async function handleSubmit(e) {
    //   e.preventDefault();
    //   setLoading(true);

    //   const { error } = await stripe.confirmPayment({
    //     elements,
    //     confirmParams: {
    //       // Make sure to change this to your payment completion page
    //       return_url: "{{ route('users.buyTicketThanks') }}",
    //       receipt_email: "{{ $auth_user->email }}",
    //     },
    //   });

    //   // This point will only be reached if there is an immediate error when
    //   // confirming the payment. Otherwise, your customer will be redirected to
    //   // your `return_url`. For some payment methods like iDEAL, your customer will
    //   // be redirected to an intermediate site first to authorize the payment, then
    //   // redirected to the `return_url`.
    //   if (error.type === "card_error" || error.type === "validation_error") {
    //     showMessage(error.message);
    //   } else {
    //     showMessage("An unexpected error occurred.");
    //   }

    //   setLoading(false);
    // }

    // // Fetches the payment intent status after payment submission
    // async function checkStatus() {
    //   const clientSecret = new URLSearchParams(window.location.search).get(
    //     "payment_intent_client_secret"
    //   );

    //   if (!clientSecret) {
    //     return;
    //   }

    //   const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

    //   switch (paymentIntent.status) {
    //     case "succeeded":
    //       showMessage("Payment succeeded!");
    //       break;
    //     case "processing":
    //       showMessage("Your payment is processing.");
    //       break;
    //     case "requires_payment_method":
    //       showMessage("Your payment was not successful, please try again.");
    //       break;
    //     default:
    //       showMessage("Something went wrong.");
    //       break;
    //   }
    // }

    // // ------- UI helpers -------

    // function showMessage(messageText) {
    //   const messageContainer = document.querySelector("#payment-message");

    //   messageContainer.classList.remove("hidden");
    //   messageContainer.textContent = messageText;

    //   setTimeout(function () {
    //     messageContainer.classList.add("hidden");
    //     messageText.textContent = "";
    //   }, 4000);
    // }

    // // Show a spinner on payment submission
    // function setLoading(isLoading) {
    //   if (isLoading) {
    //     // Disable the button and show a spinner
    //     document.querySelector("#submit").disabled = true;
    //     document.querySelector("#spinner").classList.remove("hidden");
    //     document.querySelector("#button-text").classList.add("hidden");
    //   } else {
    //     document.querySelector("#submit").disabled = false;
    //     document.querySelector("#spinner").classList.add("hidden");
    //     document.querySelector("#button-text").classList.remove("hidden");
    //   }
    // }


    // </script>

    ?>

    </div>



</article>

@endsection
