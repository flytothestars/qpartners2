<?php

namespace App\Http\Controllers\Admin;

use App\Admin\SocialNetwork;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use View;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $input = $request->input('category_type');
        switch ($input) {
            case ($input == About::GUIDE):
                $guide = DB::table('guide')->get();
                return view('admin.about.guide.index', ['guide' => $guide]);
                break;
            case ($input == About::ADMINISTRATION || $input == About::ADMINISTRATION_PERSONS):
                $administration = DB::table('administration')
                    ->where(['id' => 1])
                    ->first();
                $administration_persons = DB::table('administration_persons')
                    ->get();
                return view('admin.about.administration.index', [
                    'administration' => $administration,
                    'administration_persons' => $administration_persons,
                ]);
                break;
            case ($input == About::LEADERSHIP_ADVICE):
                $leadership_advice = DB::table('leadership_advice')
                    ->where(['id' => 1])
                    ->first();
                $leader_persons = DB::table('leader_persons')
                    ->get();
                return view('admin.about.leaders.index', [
                    'leadership_advice' => $leadership_advice,
                    'leader_persons' => $leader_persons,
                ]);
                break;
        }

    }

    public function create(Request $request)
    {
        $input = $request->input('category_type');

        switch ($input) {
            case ($input == About::GUIDE):
                return view('admin.about.guide.create');
                break;
            case ($input == About::ADMINISTRATION_PERSONS):
                return view('admin.about.administration.person-add');
                break;
            case ($input == About::LEADER_PERSONS):
                return view('admin.about.leaders.person-add');
                break;
        }
    }

    public function store(Request $request)
    {
        $category_type = ($request->category_type);

        switch ($category_type) {
            case About::ADMINISTRATION_PERSONS:
                if ($this->insertAdministrationPersonsData($request)) {
                    if ($errors = $this->administraionPersonsDataValidate($request)) {
                        return view('admin.about.administration.person-add', [
                            'title' => 'Добавить администратора',
                            'row' => (object)$request->all(),
                            'errors' => $errors
                        ]);
                    }
                    return redirect('admin/about?category_type=administration');
                }
                break;
            case About::LEADER_PERSONS:
                $validated = $this->leaderPersonsDataValidate($request);
                if ($validated['success'] && $this->insertLeaderPersonsData($request)) {
                    return redirect('admin/about?category_type=leadership_advice');
                }
                return view('admin.about.leaders.person-add', [
                    'title' => 'Добавить лидера',
                    'row' => (object)$request->all(),
                    'errors' => $validated['message']
                ]);
                break;
        }
    }

    public function edit($id, Request $request)
    {

        $input = $request->input('category_type');
        switch ($input) {
            case About::GUIDE:
                $row = DB::table('guide')->where('id', $id)->first();
                return view('admin.about.guide.edit', ['row' => $row]);
                break;
            case About::ADMINISTRATION_PERSONS:
                $row = DB::table('administration_persons')
                    ->where(['administration_persons.id' => $id])->first();
                $instagramLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::INSTAGRAM])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION_PERSON])
                    ->first();
                $whatsappLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::WHATSAPP])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION_PERSON])
                    ->first();
                $facebookLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::FACEBOOK])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION_PERSON])
                    ->first();
                return view('admin.about.administration.person-edit', [
                    'row' => $row,
                    'instagramLink' => $instagramLink,
                    'whatsappLink' => $whatsappLink,
                    'facebookLink' => $facebookLink,
                ]);

            case About::ADMINISTRATION:
                $row = DB::table('administration')
                    ->where(['administration.id' => 1])->first();

                $instagramLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::INSTAGRAM])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION])
                    ->first();
                $twitterLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::TWITTER])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION])
                    ->first();
                $facebookLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::FACEBOOK])
                    ->where(['type_id' => SocialNetwork::ADMINISTRATION])
                    ->first();
                return view('admin.about.administration.edit', [
                    'row' => $row,
                    'instagramLink' => $instagramLink,
                    'twitterLink' => $twitterLink,
                    'facebookLink' => $facebookLink,
                ]);

            case About::LEADER_PERSONS:
                $row = DB::table('leader_persons')
                    ->where(['leader_persons.id' => $id])->first();
                $instagramLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::INSTAGRAM])
                    ->where(['type_id' => SocialNetwork::LEADERS_PERSON])
                    ->first();
                $twitterLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::TWITTER])
                    ->where(['type_id' => SocialNetwork::LEADERS_PERSON])
                    ->first();
                $facebookLink = DB::table('ref_social_network_items')
                    ->where(['item_id' => $id])
                    ->where(['social_network_id' => SocialNetwork::FACEBOOK])
                    ->where(['type_id' => SocialNetwork::LEADERS_PERSON])
                    ->first();
                return view('admin.about.leaders.person-edit', [
                    'row' => $row,
                    'instagramLink' => $instagramLink,
                    'twitterLink' => $twitterLink,
                    'facebookLink' => $facebookLink,
                ]);

            case About::LEADERSHIP_ADVICE:
                $row = DB::table('leadership_advice')
                    ->where(['leadership_advice.id' => $id])->first();

                return view('admin.about.leaders.edit', [
                    'row' => $row,
                ]);

        }

    }

    public function update(Request $request, $id)
    {
        $category_type = $request->input('category_type');
        switch ($category_type) {
            case About::GUIDE:
                $validated = $this->guideDataValidate($request);
                if (!$validated) {
                    $request->id = $id;
                    return view('admin.about.guide.edit', [
                        'title' => 'Изиенить слова руководителя',
                        'row' => $request,
                        'errors' => $validated['message']
                    ]);
                }
                if ($this->editGuideData($id, $request)) {
                    return redirect('admin/about?category_type=guide');
                }
                break;

            case About::ADMINISTRATION_PERSONS:
                $validated = $this->administraionPersonsDataValidate($request);
                if (!$this->administraionPersonsDataValidate($request)) {
                    return view('admin.about.administration.person-edit', [
                        'title' => 'Добавить администратора',
                        'row' => (object)$request->all(),
                        'errors' => $validated['message']
                    ]);
                }
                if ($this->updateAdministrationPersonsData($request, $id)) {
                    return redirect('admin/about?category_type=administration');
                }
                break;

            case About::LEADER_PERSONS:
                $validated = $this->leaderPersonsDataValidate($request);
                if (!$this->leaderPersonsDataValidate($request)) {
                    return view('admin.about.leaders.person-edit', [
                        'title' => 'Добавить администратора',
                        'row' => (object)$request->all(),
                        'errors' => $validated['message'],
                    ]);
                }
                if ($this->updateLeaderPersonsData($request, $id)) {
                    return redirect('admin/about?category_type=leadership_advice');
                }
                break;

            case About::ADMINISTRATION:
                if (!$errors = $this->administrationDataValidate($request)) {
                    if ($this->updateAdministrationData($request, $id)) {
                        return redirect('admin/about?category_type=administration');
                    }
                }

                $request->id = $id;
                return view('admin.about.administration.edit', [
                    'title' => 'Изменить администрацию',
                    'row' => $request,
                    'errors' => $errors
                ]);
                break;

            case About::LEADERSHIP_ADVICE:
                $validated = $this->leadershipAdviceDataValidate($request);
                $request->id = $id;
                if (!$validated['success']) {
                    return view('admin.about.leaders.edit', [
                        'title' => 'Добавить лидеров',
                        'row' => $request,
                        'errors' => $validated['message'],
                    ]);
                }
                if ($this->updateLeadershipData($request, $id)) {
                    return redirect('admin/about?category_type=leadership_advice');
                };
        }
    }


    public function leadershipAdviceDataValidate($request)
    {
        $messages = [
            'title.required' => 'Необходимо заполнить поле Название (Загаловок).',
            'text_body.required' => 'Необходимо заполнить поле Текст.',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text_body' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result['success'] = false;
            $result['message'] = $errors;
            return $result;
        }
        $result['success'] = true;
        $result['message'] = NULL;
        return $result;
    }

    public function updateLeadershipData($request, $id)
    {
        DB::table('leadership_advice')
            ->where(['id' => $id])
            ->update([
                'title' => $request->title,
                'text_body' => $request->text_body,
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ]);
        return true;

    }


    public function destroy(Request $request, $id)
    {
        $category_type = $request->input('category_type');
        switch ($category_type) {
            case About::GUIDE:
                $guide = DB::table('guide')->where(['id' => $id])->delete();
                if ($guide) {
                    return back();
                }
                break;
            case About::ADMINISTRATION_PERSONS:
                $person = DB::table('administration_persons')->where(['id' => $id])->delete();
                if ($person) {
                    return back();
                }
                break;

            case About::LEADER_PERSONS:
                $person = DB::table('leader_persons')->where(['id' => $id])->delete();
                if ($person) {
                    return back();
                }
                break;


        }
    }

    public function administrationDataValidate($request)
    {
        $messages = [
            'title.required' => 'Необходимо заполнить поле Название (Загаловок).',
            'text_body.required' => 'Необходимо заполнить поле Текст.',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text_body' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }
        return false;
    }

    public function leaderPersonsDataValidate($request)
    {
        $messages = [
            'full_name.required' => 'Необходимо заполнить поле ФИО лидера.',
            'address.required' => 'Необходимо заполнить поле Адрес лидера.',

        ];

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'address' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result['message'] = $errors;
            $result['success'] = false;
            return $result;
        }
        $result['message'] = NULL;
        $result['success'] = true;
        return $result;
    }


    public function updateAdministrationData($request, $id)
    {
        $text_body = nl2br(str_replace(" ", "&nbsp;", $request->text_body));
        DB::table('administration')
            ->where(['id' => $id])
            ->update([
                'title' => $request->title,
                'text_body' => $text_body,
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ]);
        return true;


    }


    public function guideDataValidate($request)
    {
        $messages = [
            'title.required' => 'Необходимо заполнить поле Название (Загаловок).',
            'text_body.required' => 'Необходимо заполнить поле Название Текст (Слова руководителя).',
            'author_full_name.required' => 'Необходимо заполнить поле Фамилия Имя Отчество автора.',
            'author_responsibility.required' => 'Необходимо заполнить поле Должность автора.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text_body' => 'required',
            'author_full_name' => 'required',
            'author_responsibility' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result['success'] = false;
            $result['message'] = $errors;
            return $result;
        }
        $result['success'] = true;
        $result['message'] = NULL;
        return $result;


    }

    public function administraionPersonsDataValidate($request)
    {
        $messages = [
            'full_name.required' => 'Необходимо заполнить поле ФИО).',
            'responsibility.required' => 'Необходимо заполнить поле Должность.',

        ];

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'responsibility' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result['success'] = false;
            $result['message'] = $errors;
            return $result;
        }
        $result['success'] = true;
        $result['message'] = NULL;
        return $result;
    }

    public function insertAdministrationPersonsData($request)
    {
        DB::transaction(function () use ($request) {
            $person_id = DB::table('administration_persons')->insertGetId([
                'full_name' => $request->full_name,
                'responsibility' => $request->responsibility,
                'image' => $request->image,
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ]);

            if ($request->has_instagram) {
                DB::table('ref_social_network_items')->insert([
                    'social_network_id' => SocialNetwork::INSTAGRAM,
                    'item_id' => $person_id,
                    'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                    'url' => $request->person_instagram_link,
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i'),
                ]);
            }

            if ($request->has_facebook) {
                DB::table('ref_social_network_items')->insert([
                    'social_network_id' => SocialNetwork::FACEBOOK,
                    'item_id' => $person_id,
                    'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                    'url' => $request->person_facebook_link,
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i'),
                ]);
            }

            if ($request->has_whatsapp) {
                DB::table('ref_social_network_items')->insert([
                    'social_network_id' => SocialNetwork::WHATSAPP,
                    'item_id' => $person_id,
                    'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                    'url' => $request->person_whatsapp_link,
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i'),
                ]);
            }
        });

        return true;
    }


    public function insertLeaderPersonsData($request)
    {

        try {
            DB::transaction(function () use ($request) {
                $person_id = DB::table('leader_persons')->insertGetId([
                    'full_name' => $request->full_name,
                    'address' => $request->address,
                    'image' => $request->image,
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i'),
                ]);
                if ($request->has_instagram) {
                    DB::table('ref_social_network_items')->insert([
                        'social_network_id' => SocialNetwork::INSTAGRAM,
                        'item_id' => $person_id,
                        'type_id' => SocialNetwork::LEADERS_PERSON,
                        'url' => $request->person_instagram_link,
                        'created_at' => date('Y-m-d H:m:i'),
                        'updated_at' => date('Y-m-d H:m:i'),
                    ]);
                }
                if ($request->has_facebook) {
                    DB::table('ref_social_network_items')->insert([
                        'social_network_id' => SocialNetwork::FACEBOOK,
                        'item_id' => $person_id,
                        'type_id' => SocialNetwork::LEADERS_PERSON,
                        'url' => $request->person_facebook_link,
                        'created_at' => date('Y-m-d H:m:i'),
                        'updated_at' => date('Y-m-d H:m:i'),
                    ]);
                }
                if ($request->has_twitter) {
                    DB::table('ref_social_network_items')->insert([
                        'social_network_id' => SocialNetwork::TWITTER,
                        'item_id' => $person_id,
                        'type_id' => SocialNetwork::LEADERS_PERSON,
                        'url' => $request->person_twitter_link,
                        'created_at' => date('Y-m-d H:m:i'),
                        'updated_at' => date('Y-m-d H:m:i'),
                    ]);
                }
            });
        } catch (\PDOException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function updateAdministrationPersonsData($request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                DB::table('administration_persons')
                    ->where(['id' => $id])
                    ->update([
                        'full_name' => $request->full_name,
                        'responsibility' => $request->responsibility,
                        'image' => $request->image,
                        'created_at' => date('Y-m-d H:m:i'),
                        'updated_at' => date('Y-m-d H:m:i'),
                    ]);

                if ($request->has_instagram) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'social_network_id' => SocialNetwork::INSTAGRAM
                        ])->first();
                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                                'social_network_id' => SocialNetwork::INSTAGRAM
                            ])
                            ->update([
                                'url' => $request->person_instagram_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::INSTAGRAM,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'url' => $request->person_instagram_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }
                if ($request->has_facebook) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'social_network_id' => SocialNetwork::FACEBOOK
                        ])->first();
                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                                'social_network_id' => SocialNetwork::FACEBOOK
                            ])
                            ->update([
                                'url' => $request->person_facebook_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::FACEBOOK,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'url' => $request->person_facebook_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }

                if ($request->has_whatsapp) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'social_network_id' => SocialNetwork::WHATSAPP
                        ])->first();

                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                                'social_network_id' => SocialNetwork::WHATSAPP
                            ])
                            ->update([
                                'url' => $request->person_whatsapp_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::WHATSAPP,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::ADMINISTRATION_PERSON,
                            'url' => $request->person_whatsapp_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }
            });
        } catch (\PDOException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function updateLeaderPersonsData($request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                DB::table('leader_persons')
                    ->where(['id' => $id])
                    ->update([
                        'full_name' => $request->full_name,
                        'address' => $request->address,
                        'image' => $request->image,
                        'created_at' => date('Y-m-d H:m:i'),
                        'updated_at' => date('Y-m-d H:m:i'),
                    ]);

                if ($request->has_instagram) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'social_network_id' => SocialNetwork::INSTAGRAM
                        ])->first();
                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::LEADERS_PERSON,
                                'social_network_id' => SocialNetwork::INSTAGRAM
                            ])
                            ->update([
                                'url' => $request->person_instagram_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::INSTAGRAM,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'url' => $request->person_instagram_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }
                if ($request->has_facebook) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'social_network_id' => SocialNetwork::FACEBOOK
                        ])->first();
                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::LEADERS_PERSON,
                                'social_network_id' => SocialNetwork::FACEBOOK
                            ])
                            ->update([
                                'url' => $request->person_facebook_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::FACEBOOK,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'url' => $request->person_facebook_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }

                if ($request->has_twitter) {
                    $check = DB::table('ref_social_network_items')
                        ->where([
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'social_network_id' => SocialNetwork::TWITTER
                        ])->first();

                    if (count($check)) {
                        DB::table('ref_social_network_items')
                            ->where([
                                'item_id' => $id,
                                'type_id' => SocialNetwork::LEADERS_PERSON,
                                'social_network_id' => SocialNetwork::TWITTER
                            ])
                            ->update([
                                'url' => $request->person_twitter_link,
                                'created_at' => date('Y-m-d H:m:i'),
                                'updated_at' => date('Y-m-d H:m:i'),
                            ]);
                    } else {
                        DB::table('ref_social_network_items')->insert([
                            'social_network_id' => SocialNetwork::TWITTER,
                            'item_id' => $id,
                            'type_id' => SocialNetwork::LEADERS_PERSON,
                            'url' => $request->person_twitter_link,
                            'created_at' => date('Y-m-d H:m:i'),
                            'updated_at' => date('Y-m-d H:m:i'),
                        ]);
                    }
                }
            });
        } catch (\PDOException $e) {
//            var_dump($e->getMessage());
            return false;
        } catch (\Exception $e) {
//            var_dump($e->getMessage());
            return false;
        }
        return true;
    }

    public function insertAdministrationData($request)
    {
//        $dbInsert = DB::table('');
//        if ($dbInsert) {
//            return true;
//        }
//        return false;
    }

    public function editGuideData($id, $request)
    {
        $text_body = nl2br(str_replace(" ", " &nbsp;", $request->text_body));
        $bdUpdate = DB::table('guide')
            ->where(['id' => $id])
            ->update([
                'title' => $request->title,
                'text_body' => $text_body,
                'author_full_name' => $request->author_full_name,
                'author_responsibility' => $request->author_responsibility,
                'author_instagram_link' => $request->author_instagram_link,
                'author_whatsapp_link' => $request->author_whatsapp_link,
                'author_twitter_link' => $request->author_twitter_link,
                'author_facebook_link' => $request->author_facebook_link,
                'updated_at' => date('Y-m-d H:m:i'),
            ]);

        if ($bdUpdate) {
            return true;
        }
        return false;
    }
}
