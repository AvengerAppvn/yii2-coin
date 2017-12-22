<?php

namespace backend\controllers;

use yii\web\Controller;

class NotificationController extends Controller
{

    public function actionIndex()
    {
        return 1;
    }

// {
//   "id": "cbb019fe-e04d-5b65-8321-95ecc6353c1b",
//   "type": "wallet:orders:paid",
//   "data": {
//     "resource": {
//       "id": "1f03b664-4c19-53d3-af34-62d6bad031b9",
//       "code": "NXH22AZT",
//       "type": "order",
//       "name": "Good vibes",
//       "description": "Positive thoughts and good vibes.",
//       "amount": {
//         "amount": "0.02",
//         "currency": "USD"
//       },
//       "receipt_url": "https:\/\/www.coinbase.com\/orders\/582cc9caaad4e55e36817599197c5efd\/receipt",
//       "resource": "order",
//       "resource_path": "\/v2\/orders\/1f03b664-4c19-53d3-af34-62d6bad031b9",
//       "status": "paid",
//       "bitcoin_amount": {
//         "amount": "0.00006100",
//         "currency": "BTC"
//       },
//       "payout_amount": null,
//       "bitcoin_address": "1KcGmmoyYrLkQGHuR48yxGFZiEt3F5x6Rh",
//       "refund_address": null,
//       "bitcoin_uri": "bitcoin:1KcGmmoyYrLkQGHuR48yxGFZiEt3F5x6Rh?amount=0.000061&r=https:\/\/www.coinbase.com\/r\/5644f61bb750bc5fab0001ac",
//       "paid_at": "2015-11-12T20:27:45Z",
//       "mispaid_at": null,
//       "expires_at": "2015-11-12T20:42:07Z",
//       "metadata": {},
//       "created_at": "2015-11-12T20:27:07Z",
//       "updated_at": "2015-11-12T20:27:45Z",
//       "customer_info": null,
//       "transaction": {
//         "id": "fd8e4e97-5df4-5fb4-8357-8182fe3d03ef",
//         "resource": "transaction",
//         "resource_path": "\/v2\/accounts\/81180219-027c-5d68-b38e-e7f3d0a4a5ae\/transactions\/fd8e4e97-5df4-5fb4-8357-8182fe3d03ef"
//       },
//       "mispayments": [],
//       "refunds": []
//     }
//   },
//   "user": {
//     "id": "fc1c8832-e5f4-5871-9405-6b143949b5ac",
//     "resource": "user",
//     "resource_path": "\/v2\/users\/fc1c8832-e5f4-5871-9405-6b143949b5ac"
//   },
//   "account": {
//     "id": "81180219-027c-5d68-b38e-e7f3d0a4a5ae",
//     "resource": "account",
//     "resource_path": "\/v2\/accounts\/81180219-027c-5d68-b38e-e7f3d0a4a5ae"
//   },
//   "delivery_attempts": 0,
//   "created_at": "2015-11-12T20:27:45Z",
//   "resource": "notification",
//   "resource_path": "\/v2\/notifications\/cbb019fe-e04d-5b65-8321-95ecc6353c1b"
// }
// mispaid
// {
//   "id": "c303dfd8-9127-5863-9b90-49917fcef9b5",
//   "type": "wallet:orders:mispaid",
//   "data": {
//     "resource": {
//       "id": "210fec4f-44f7-50f6-b3ec-f4cddac57029",
//       "code": "7UWSY29R",
//       "type": "order",
//       "name": "Good vibes",
//       "description": "Positive thoughts and good vibes.",
//       "amount": {
//         "amount": "1.00",
//         "currency": "USD"
//       },
//       "receipt_url": "https:\/\/www.coinbase.com\/orders\/69a076d7c242d3777e3861425cad6105\/receipt",
//       "resource": "order",
//       "resource_path": "\/v2\/orders\/210fec4f-44f7-50f6-b3ec-f4cddac57029",
//       "status": "mispaid",
//       "bitcoin_amount": {
//         "amount": "0.00242400",
//         "currency": "BTC"
//       },
//       "payout_amount": null,
//       "bitcoin_address": "1FDKRYFxKvp1jg2PLxKpj6YkxXnBHbQNjH",
//       "refund_address": null,
//       "bitcoin_uri": "bitcoin:1FDKRYFxKvp1jg2PLxKpj6YkxXnBHbQNjH?amount=0.002424&r=https:\/\/www.coinbase.com\/r\/5644fa744e607635db000083",
//       "paid_at": null,
//       "mispaid_at": "2015-11-12T20:46:38Z",
//       "expires_at": "2015-11-12T21:00:40Z",
//       "metadata": {},
//       "created_at": "2015-11-12T20:45:40Z",
//       "updated_at": "2015-11-12T20:46:38Z",
//       "customer_info": null,
//       "transaction": {
//         "id": "79147800-608a-5b80-b647-c8fa27769107",
//         "resource": "transaction",
//         "resource_path": "\/v2\/accounts\/81180219-027c-5d68-b38e-e7f3d0a4a5ae\/transactions\/79147800-608a-5b80-b647-c8fa27769107"
//       },
//       "mispayments": [
//         {
//           "id": "56b1dc24-0bfc-52ec-84be-555d23d528dc",
//           "amount": {
//             "amount": "0.00022400",
//             "currency": "BTC"
//           },
//           "native_amount": {
//             "amount": "0.07",
//             "currency": "USD"
//           },
//           "refund_address": null,
//           "transaction": {
//             "id": "79147800-608a-5b80-b647-c8fa27769107",
//             "resource": "transaction",
//             "resource_path": "\/v2\/accounts\/81180219-027c-5d68-b38e-e7f3d0a4a5ae\/transactions\/79147800-608a-5b80-b647-c8fa27769107"
//           },
//           "refund_transaction": null,
//           "created_at": "2015-11-12T20:46:38Z",
//           "updated_at": "2015-11-12T20:46:38Z"
//         }
//       ],
//       "refunds": []
//     }
//   },
//   "user": {
//     "id": "fc1c8832-e5f4-5871-9405-6b143949b5ac",
//     "resource": "user",
//     "resource_path": "\/v2\/users\/fc1c8832-e5f4-5871-9405-6b143949b5ac"
//   },
//   "account": {
//     "id": "81180219-027c-5d68-b38e-e7f3d0a4a5ae",
//     "resource": "account",
//     "resource_path": "\/v2\/accounts\/81180219-027c-5d68-b38e-e7f3d0a4a5ae"
//   },
//   "delivery_attempts": 0,
//   "created_at": "2015-11-12T20:46:38Z",
//   "resource": "notification",
//   "resource_path": "\/v2\/notifications\/c303dfd8-9127-5863-9b90-49917fcef9b5"
// }
}
