<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request){
        // Prendo i dati dalla request
        $data = $request->all();

        // Validazione

        $validator = Validator::make($data,[
            'email' => 'required|email',
            'subject' => 'required|string',
            'content' => 'required|string',
        ],
        [
            'email.required' => 'Mail is required',
            'email.email' => 'Mail is not valid',
            'subject.required' => 'Subject field is required',
            'content.required' => 'Mail content is required',
        ]);

        //Manipolo l'oggetto errors che mi arriva come risposta se c'è qualche errore dopo la validazione, per avere più facilità nel mettere i dati a front 
        if($validator->fails()){
            $errors = [];
            foreach($validator->errors()->messages() as $field => $messages){
                $errors[$field] = $messages[0];
            };

            return response()->json(compact('errors'), 422); //422 = unprocessable entity
        }

        // Istanzo la mail
        $mail = new ContactMessageMail($data['email'], $data['subject'], $data['content']);
        
        // Mando la mail
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);

        return response()->json('Inviato con successo');

    }

}
