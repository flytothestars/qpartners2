<?php

namespace App\Http\Controllers\Index;

use App\Models\Faq;
use App\Models\FaqStatuses;
use App\Models\OpportunityFAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class FaqController extends Controller
{
    public function show()
    {
        $faqs = Faq::where(['is_active' => true])->get();
        return view('design_index.faq.show', ['faqs' => $faqs]);
    }

    public function opportunityFaqStore(Request $request)
    {
        $messages = [
            'user_name.required' => 'Необходимо заполнить поле Имя).',
            'user_email.required' => 'Необходимо заполнить поле E-mail.',
            'user_phone.required' => 'Необходимо заполнить поле Номер телефона.',
        ];

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_phone' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $request->session()->flash('danger', 'Произошла ошибка');
            return back();
        }

        $opportunityFaq = new OpportunityFAQ();
        $opportunityFaq->user_name = $request->user_name;
        $opportunityFaq->user_email = $request->user_email;
        $opportunityFaq->user_phone = $request->user_phone;
        $opportunityFaq->question = $request->question;
        $opportunityFaq->status_id = FaqStatuses::WAITING;
        if ($opportunityFaq->save()) {
            $request->session()->flash('success', 'Вы успешно написали в службу поддержку');
            return back();
        }
    }
}
